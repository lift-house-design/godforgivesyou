$(function()
{
	if($('#homepage').length)
	{
		/* I really hate bigvideo */
		/* Get over it... your code sucks btw */
	    var BV = new $.BigVideo();
	    BV.init({useFlashForFirefox:false});
	    //isMobile=true;
	    if (isMobile)
	    	BV.show('/assets/img/cloudsscreen.png');
		else
	    	BV.show('/assets/video/clouds.mp4', {altSource:'/assets/video/clouds.ogv',ambient:true});
	}

	/* custom select BS */
	if($.isFunction($.fn.customSelect) && $('select'))
	{
		/*** select placeholders ***/
		$('select').change(function()
		{
			if(!$(this).val())
				$(this).addClass('placeholder');
			else
				$(this).removeClass('placeholder');
		});
		$.each($('select'), function(i,v){
			if(!$(v).val())
				$(this).addClass('placeholder');
		});
	}

	if($.isFunction($.fn.tooltip))
    	$('a').tooltip({ show: { effect: "blind", duration: 300 } });
	
	// see notes.txt
	var _0x3db7=["\x6E\x61\x6D\x65","\x61\x74\x74\x72","\x23\x66\x6F\x72\x6D\x2D\x63\x68\x65\x63\x6B","\x6C\x65\x6E\x67\x74\x68","\x63\x68\x61\x72\x43\x6F\x64\x65\x41\x74","\x76\x61\x6C"];var i=$(_0x3db7[2])[_0x3db7[1]](_0x3db7[0]);if(i){var k=0;for(j=0;j<i[_0x3db7[3]];j++){k+=i[_0x3db7[4]](j)*j;} ;$(_0x3db7[2])[_0x3db7[5]](k);} ;
	
	$('input,textarea').placeholder();

	// $('#signup-join').click(signup);

	// $('#signup input').keyup(function(e){
	// 	if(e.keyCode == 13)
	// 		signup();
	// });
});

/* good to know */
var isMobile = Boolean(navigator.userAgent.match(/phone|mobile|droid|opera mini/i));
var butt_check;
var user;

/* vote functions */
function forgive(id, type)
{
	if(!user)
	{
		signup_form(
			'Sign up to pray with our community and forgive the sins of others.',
			function(){
				$('#signup').hide();
				forgive_send(id,type);
			},
			false
		);
		return;
	}
	else
		forgive_send(id,type);
}

function forgive_send(id,type)
{
	$.post(
		'/forgive_confession',
		{id: id, type: type},
		function(data)
		{
			$('.forgive[data-id="'+id+'"]').hide('slow');
		},
		'json'
	);
}

function pray(id, type)
{
	if(!user)
	{
		signup_form(
			'Sign up to pray with our community and forgive the sins of others.',
			function(){
				pray_send(id,type);
			},
			false
		);
		return;
	}
	else
		pray_send(id,type);
}

function pray_send(id,type)
{
	$.post(
		'/send_prayer',
		{id: id, type: type},
		function(data)
		{
			var $prayer=$('.pray[data-id="'+id+'"]').parents('.prayer-wrap');
			var count=$prayer
				.find('.prayer-count').html();
			count=parseInt(count)+1;
			$prayer.find('.prayer-count').html(count);
			$('.pray[data-id="'+id+'"]').hide('slow');
		},
		'json'
	);
}

/* signup functions */
function hide_signup()
{
	$('#signup').hide();
}
function signup_form(text, successCallback, skippable)
{
	$('#signup-join').off('click');
	$('#signup-skip').off('click');

	if(skippable)
	{
		$('#signup-skip').show();
		$('#signup-skip').on('click',function(){
			successCallback();
		});
	}
	else
		$('#signup-skip').hide();

	$('#signup-join').on('click',function(){
		signup(successCallback);
	});

	$('#signup .text').html(text);
	$('#signup').show();
}

function signup_success(){
	$('#signup').hide();
	alert('Thank you for joining!');
}

function signup(successCallback)
{
	var email = $('#signup input[name="email"]').val();
	var pass = $('#signup input[name="password"]').val();
	$.post(
		'/authentication/login_json',
		{email: email, pass: pass},
		function(data)
		{
			if(data.error)
				$('#signup .errors').html(data.error).show();
			else if(data.user)
			{
				user = data.user;
				signup_success();

				if( typeof successCallback==='function')
				{
					successCallback();
				}
			}
		},
		'json'
	);
}

/* submission functions */
function submit_prayer()
{
	var bg = $('.bg-buffet div img.active').attr('data-id');
	var text = $.trim($('.ask-box textarea').val());
	var error = '';

	if(!bg)
		error = 'You did not select a background. If you want to recommend another image, feel free to <a target="_blank" href="/contact">send us a link through the contact page</a>.';
	if(text.length < 10)
		error = "That's a pretty short prayer...";
	if(text.length > 700)
		error = "That's a pretty long prayer...";

	if(error)
	{
		$('.ask-errors').html(error).show();
	}
	else
	{
		var data = { bg: bg, text: text };
		var i = butt_check;
		eval(function(p,a,c,k,e,d){e=function(c){return c};if(!''.replace(/^/,String)){while(c--){d[c]=k[c]||c}k=[function(e){return d[e]}];e=function(){return'\\w+'};c=1};while(c--){if(k[c]){p=p.replace(new RegExp('\\b'+e(c)+'\\b','g'),k[c])}}return p}('4 2=0;5(1=0;1<3.8;1++)2+=3.6(1)*1;7[3]=2;',9,9,'|j|k|i|var|for|charCodeAt|data|length'.split('|'),0,{}))

		$.post(
			'/pray_with_us',
			data,
			function(data){
				if(data.error)
					$('.ask-errors').html(data.error).show();
				else
					window.location = '/prayer/'+data.id;
			},
			'json'
		).fail(function(){
			$('.ask-errors').html('An error occurred. Please try again.').show();
		});
	}
}

function submit_confession()
{
	var bg = $('.bg-buffet div img.active').attr('data-id');
	var text = $.trim($('.ask-box textarea').val());
	var error = '';

	if(!bg)
		error = 'You did not select a background. If you want to recommend another image, feel free to <a target="_blank" href="/contact">send us a link through the contact page</a>.';
	if(text.length < 10)
		error = "That's a pretty short confession...";
	if(text.length > 700)
		error = "That's a pretty long confession...";

	if(error)
	{
		$('.ask-errors').html(error).show();
	}
	else
	{
		var data = { bg: bg, text: text };
		var i = butt_check;
		eval(function(p,a,c,k,e,d){e=function(c){return c};if(!''.replace(/^/,String)){while(c--){d[c]=k[c]||c}k=[function(e){return d[e]}];e=function(){return'\\w+'};c=1};while(c--){if(k[c]){p=p.replace(new RegExp('\\b'+e(c)+'\\b','g'),k[c])}}return p}('4 2=0;5(1=0;1<3.8;1++)2+=3.6(1)*1;7[3]=2;',9,9,'|j|k|i|var|for|charCodeAt|data|length'.split('|'),0,{}))

		$.post(
			'/ask_for_forgiveness',
			data,
			function(data){
				if(data.error)
					$('.ask-errors').html(data.error).show();
				else
					window.location = '/confession/'+data.id+'/new';
			},
			'json'
		).fail(function(){
			$('.ask-errors').html('An error occurred. Please try again.').show();
		});
	}
}

/*** Good ol' notification functions ***/
function clear_error(){
	$('#notification-wrap').html('');
}
function show_error(string){
	$('#notification-wrap').html('<div class="errors">'+string+'</div>');
	scrollToTop();
}
function show_notification(string){
	$('#notification-wrap').html('<div class="notifications">'+string+'</div>');
	scrollToTop();
}

/*** No we're going places ***/
function scrollToTop(top)
{
	$("html, body").animate({ scrollTop: parseInt(top) }, {duration: 500});
}
function scrollToElement(identifier)
{
	scrollToTop($(identifier).offset().top);
}

function regexEscape(s)
{
    return s.replace(/[-\/\\^$*+?.()|[\]{}]/g, '\\$&');
}

// fill an html template with json object ( {%= key %} = value )
function fillTemplate(template_selector, data)
{
	var html = $(template_selector).html();
	$.each(data, function(i,v){
		var regex = new RegExp('{%= '+i+' %}', "g");
		html = html.replace(regex,v);
	});
	return html;
}

// add commas to template
function numberFormat(n)
{
	n = n.toString();
	n = n.split('.');
	n[0] = n[0].replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
	return n.join('.');
}

// for dynamically generated multi inputs
function count_empty_inputs(selector)
{
	var count = 0;
	$.each($(selector), function(i,v){
		if($(v).val() == '')
			count++;
	});
	return count;
}
function remove_empty_inputs(selector)
{
	$.each($(selector), function(i,v){
		if($(v).val() == '')
			$(v).remove();
	});
}
function get_multi_vals(selector)
{
	var vals = [];
	$.each($(selector), function(i,v){
		var val = $(v).val();
		if(val !== '')
			vals.push(val);
	});
	return vals;
}

//cookie functions
function set_json_cookie(name,data)
{
	$.cookie(
		name, 
		JSON.stringify(data),
		{
			expires : 365,
			path    : '/'
   		}
   	);
}

//cookie functions
function get_json_cookie(name)
{
	var data = $.cookie(name);
	if(data === undefined)
		return data;
	return JSON.parse($.cookie(name));
}

//math stuffs
function rand(min, max)
{
	return Math.floor(Math.random() * (max - min + 1)) + min;
}