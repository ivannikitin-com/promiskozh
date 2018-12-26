	$.extend({
		getUrlVars: function(){
			var vars = [], hash;
			var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
			for(var i = 0; i < hashes.length; i++)
			{
				hash = hashes[i].split('=');
				vars.push(hash[0]);
				vars[hash[0]] = hash[1];
			}
			return vars;
		},
		getUrlVar: function(name){
			return $.getUrlVars()[name];
		}
	});
	var utm_source = $.getUrlVar('utm_source');
	if(utm_source){}else{utm_source = $.cookie('utm_source') || '';}
	var utm_medium = $.getUrlVar('utm_medium');
	if(utm_medium){}else{utm_medium =$.cookie('utm_medium') ||  '';}
	var utm_campaign = $.getUrlVar('utm_campaign');
	if(utm_campaign){}else{utm_campaign =$.cookie('utm_campaign') ||  '';}
	var utm_term = $.getUrlVar('utm_term');
	if(utm_term){}else{utm_term = $.cookie('utm_term') || '';}
	var utm_content = $.getUrlVar('utm_content');
	if(utm_content){}else{utm_content = $.cookie('utm_content') || '';}
	
	domName = window.location.hostname;

	pathName = window.location.pathname;
	
	$.cookie('utm_source', utm_source, {expires: 1,	path: pathName,domain: domName});
	$.cookie('utm_medium', utm_medium, {expires: 1,	path: pathName,domain: domName});
	$.cookie('utm_campaign', utm_campaign, {expires: 1,	path: pathName,domain: domName});
	$.cookie('utm_term', utm_term, {expires: 1,	path: pathName,domain: domName});
	$.cookie('utm_content', utm_content, {expires: 1,	path: pathName,domain: domName});