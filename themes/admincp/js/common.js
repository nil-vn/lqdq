$(document).ready(function(){
	/* Validate Phone*/
	$(".btn-validate-phone").live('click',function(){
		var _this = $(this);
		var isValidate = _this.attr('rel');
		var userId = _this.attr('uuid');
		var varType = _this.attr('valtype');
		$.ajax({
			type:'POST',
			url:webroot+'/common/validatePhone',
			data:{'user_id':userId,'isValidate':isValidate,'varType':varType},
			beforeSend:function(){
				if(isValidate == 99){
					_this.parent().find('span.label').html('A VERIFIER');
					_this.parent().find('span.time').remove();
					_this.parent().find('span.label').removeClass('label-success').addClass('label-important');
					var buttonHtml = '<button valtype="'+varType+'" type="button" uuid="'+userId+'" rel="1" class="btn btn-small btn-success btn-validate-phone">VALIDE</button>';
						buttonHtml+= '<button valtype="'+varType+'" type="button" uuid="'+userId+'" rel="0" class="btn btn-small btn-danger btn-validate-phone">INCORRECTE</button>';
					$(buttonHtml).insertAfter(_this);
					_this.remove();
				}else{
					var label = _this.parent().find('span.label');
					if(isValidate ==1){
						_this.parent().find('span.label').html('OK');
						_this.parent().find('span.label').removeClass('label-important').addClass('label-success');
					}else{
						_this.parent().find('span.label').html('BAD');
						_this.parent().find('span.label').removeClass('label-success').addClass('label-important');
					}
					var buttonHtml = '<button valtype="'+varType+'" type="button" uuid="'+userId+'" rel="99" class="btn btn-small btn-danger btn-validate-phone">MODIFIER</button>';
						buttonHtml+= '<span class="time">'+date('m/d/Y H:i:s A')+'</span>';
					_this.parent().find('button').remove();
					$(buttonHtml).insertAfter(label);
				}
			},
			success:function(res){
				if(res.error){
					errorNot();
				}
			}
		});
		return false;
	});
	/* Phương thức dùng để kiểm tra Only input Number */
	$("input.number-mask").keypress(function(event) {
		// Backspace, tab, enter, end, home, left, right
		// We don't support the del key in Opera because del == . == 46.
		var controlKeys = [8, 9, 13, 35, 36, 37, 39];
		// IE doesn't support indexOf
		var isControlKey = controlKeys.join(",").match(new RegExp(event.which));
		// Some browsers just don't raise events for control keys. Easy.
		// e.g. Safari backspace.
		if (!event.which || // Control keys in most browsers. e.g. Firefox tab is 0
			(48 <= event.which && event.which <= 57) || // Always 1 through 9
			(48 == event.which && $(this).attr("value")) || // No 0 first digit
			isControlKey) { // Opera assigns values for control keys.
			return;
		} else {
			event.preventDefault();
		}
	});
	
	/* Phương thức dùng để giới hạn ký tự nhập vào cho input*/
	$('.input.limit-char').unbind('keyup change input paste').bind('keyup change input paste',function(e){
		var $this = $(this);
		var val = $this.val();
		var valLength = val.length;
		var maxCount = $this.attr('maxlength');
		if(valLength>maxCount){
			$this.val($this.val().substring(0,maxCount));
		}
	});
});

function errorNot(){
	var html = "<b>Une erreur est survenue</b>";
	alertify.set({ labels : { ok: "OK"} });
	alertify.alert(html,function(e){
		if(e){
			window.location.reload();
		}
	});
}
function error(html){
	html = '<b>Veuillez vérifier les champs suivants :</b><br />'+html;
	alertify.set({ labels : { ok: "Fermer"} });
	alertify.alert(html);
}
function setError(errors,form){
	form.find("input").removeClass('error');
	var html = "<b>Veuillez vérifier les champs suivants :</b><br />";
	$.each(errors,function(x,y){
		$.each(y,function(i,n){
			html+=n+'<br />';
		});
		$(form).find('.'+x).addClass('error');
		$(form).find('.'+x).focus();
	});
	alertify.set({ labels : { ok: "Fermer"} });
	alertify.alert(html);
}
function getSubCategory(categoryId,element,objCategoryId)
{
	$.ajax({
		type:'POST',
		url:webroot+'/common/getSubCategory',
		data:{'category_id':categoryId},
		beforeSend:function(){
			element.parent().parent().append('<span id="loadGetCategory">Chargement en cours ...</span>');
		},
		success:function(res){
			$("#loadGetCategory").remove();
			if(!$.isEmptyObject(res)){
				var group1 = '';
				var group2 = '';
				var group3 = '';
				var countGroup1 = 0;
				var countGroup2 = 0;
				var countGroup3 = 0;
				var isChecked = '';
				var array=objCategoryId;//[]
				/*$(objCategoryId).each(function(i,n) {
					array.push(n);
				});*/
				$.each(res,function(x,y){
					if(findFirstKeyByValue(array,y.id) != null){
						isChecked = 'checked="true"';
					}else{
						isChecked = '';
					}
					if(y.type == 1)
					{
						countGroup1++;
						group1+='<small style="margin-left: 20px;"><input name="Category[]" data-parent="'+y.parent_id+'" class="checkbox-category" data-group="group1" '+isChecked+' type="checkbox" value="'+y.id+'" /> '+y.category_name+'</small>';
					}else if(y.type == 2){
						countGroup2++;
						group2+='<small style="margin-left: 20px;"><input name="Category[]" data-parent="'+y.parent_id+'" class="checkbox-category" data-group="group2" '+isChecked+' type="checkbox" value="'+y.id+'" /> '+y.category_name+'</small>';
					}else{
						countGroup3++;
						group3+='<small style="margin-left: 20px;"><input name="Category[]" data-parent="'+y.parent_id+'" class="checkbox-category" data-group="group3" '+isChecked+' type="checkbox" value="'+y.id+'" /> '+y.category_name+'</small>';
					}
				});
				if(group1 != '')
					group1 = "<span>Option(s) facultative(s)</span>"+group1;
				if(group2 != '')
					group2 = "<span>Option(s) facultative(s)</span>"+group2;
				if(group3 != '')
					group3 = "<span>Option(s) facultative(s)</span>"+group3;
				var group = group1+group2+group3;
				element.parent().parent().append('<div class="box-sub-category">'+group+'</div>');
			}else{
				// alert('ERROR: cannot find sub categories.');
			}
		}
	});
}
function showloadPage()
{
	$("body").append('<div id="show_load_page"><img src="'+themeUrl+'/img/spinner-mini.gif" /></div>');
	var paddingTop = $(window).height()/2;
	var paddingLeft = $(window).width()/2;
	$("#show_load_page").css({'background':'#fff','position': 'fixed','width':'100%','height':'100%','z-index':'999999','top':0,'opacity':0.6,'padding-top':paddingTop,'padding-left':paddingLeft});
}
function hideLoadPage()
{
	$("#show_load_page").remove();
}
/**
* Phương thức dùng để show message
* typeShow: top-left, top-center, top-right, middle-left, middle-center, middle-right
*/
function message(type,msg,timeout){
	alertify.set({ delay: timeout });
	if(type == 'success')
		alertify.success(msg);
	else if(type == 'error')
		alertify.error(msg);
	else
		alertify.log(msg);
}
function validateEmail(email) { 
	var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
	return re.test(email);
}
function isset(strVariableName){
	return( typeof( strVariableName ) != 'undefined' );
}
function findFirstKeyByValue(obj, val) {
	for (var key in obj) {
		if (obj.hasOwnProperty(key) && obj[key] == val) {
			return key;
		}
	}
	return null;
}
function ScrollToTop(el,callback) {
	jQuery('html, body').animate({ scrollTop: jQuery(el).offset().top-1}, 1500, callback);
	//IE, Opera, Safari
	jQuery('html, body').bind('mousewheel', function(e){
		jQuery('html, body').stop();
	});
	//Firefox
	jQuery('html, body').bind('DOMMouseScroll', function(e){
		jQuery('html, body').stop();
	});
}
function loadSubLesOptions(_this){
	var objCategoryFieldId;
	if($.isEmptyObject(objCategoryFieldId)){
		// alert('Category Empty');
		setTimeout(function(){
			$("ul.nav-tabs a[href='#tab2']").click();
		},100);
	}else{
		$.ajax({
		type:'POST',
		url:webroot+'/common/getAllValueLesOption',
		data:{'arrId':objCategoryFieldId,'property_id':_this.data('property')},
		beforeSend:function(){
			var insert = _this.parent().parent().find('p#lesoptiontitle');
			$('<span id="loadGetCategory">Loading...</span>').insertAfter($(insert));
		},
		success:function(res){
			_this.parent().parent().find("#loadGetCategory").remove();
			if(res.error == true){
				alert('ERROR:false');
			}else{
				$(".list-lesoption span").remove();
					var arrValues = [];
					var checked = '';
					$.each(res.values,function(x,y){
						y = $.parseJSON(y);
						$.merge(arrValues,y);
					});
					$.each(res.data,function(x,y){
						//console.log(res.data);
						var name = $(".box-lesoption[data-id='"+x+"']").data('htmlname');
						//name = name.replace("[]","["+x+"]");
						name = x+'_'+name;
						$.each(y,function(i,n){
							if(findFirstKeyByValue(arrValues,i) != null){
								checked = 'checked="true"';
							}else{
								checked = '';
							}
							$(".list-lesoption-"+x).prepend('<span><input name="'+name+'" '+checked+' type="checkbox" value="'+i+'"> '+n+'</span>');
						});
					});
				}
			}
		});
	}
}
function date(format,timestamp){
	var that = this,
	jsdate,
	f,
	formatChr = /\\?([a-z])/gi,
	formatChrCb,
	// Keep this here (works, but for code commented-out
	// below for file size reasons)
	//, tal= [],
	_pad = function (n, c) {
	n = n.toString();
	return n.length < c ? _pad('0' + n, c, '0') : n;
	},
	txt_words = ["Sun", "Mon", "Tues", "Wednes", "Thurs", "Fri", "Satur", "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
	formatChrCb = function (t, s) {
	return f[t] ? f[t]() : s;
	};
	f = {
	// Day
	d: function () { // Day of month w/leading 0; 01..31
		return _pad(f.j(), 2);
	},
	D: function () { // Shorthand day name; Mon...Sun
		return f.l().slice(0, 3);
	},
	j: function () { // Day of month; 1..31
		return jsdate.getDate();
	},
	l: function () { // Full day name; Monday...Sunday
		return txt_words[f.w()] + 'day';
	},
	N: function () { // ISO-8601 day of week; 1[Mon]..7[Sun]
		return f.w() || 7;
	},
	S: function () { // Ordinal suffix for day of month; st, nd, rd, th
		var j = f.j();
		if(j < 4 || j > 20){
			return (['st', 'nd', 'rd'])[j % 10 - 1];
		}
		else
		{
			return 'th';
		}
	},
	w: function () { // Day of week; 0[Sun]..6[Sat]
		return jsdate.getDay();
	},
	z: function () { // Day of year; 0..365
	  var a = new Date(f.Y(), f.n() - 1, f.j()),
	    b = new Date(f.Y(), 0, 1);
	  return Math.round((a - b) / 864e5);
	},

	// Week
	W: function () { // ISO-8601 week number
		var a = new Date(f.Y(), f.n() - 1, f.j() - f.N() + 3),
			b = new Date(a.getFullYear(), 0, 4);
		return _pad(1 + Math.round((a - b) / 864e5 / 7), 2);
	},

	// Month
	F: function () { // Full month name; January...December
		return txt_words[6 + f.n()];
	},
	m: function () { // Month w/leading 0; 01...12
		return _pad(f.n(), 2);
	},
	M: function () { // Shorthand month name; Jan...Dec
		return f.F().slice(0, 3);
	},
	n: function () { // Month; 1...12
		return jsdate.getMonth() + 1;
	},
	t: function () { // Days in month; 28...31
		return (new Date(f.Y(), f.n(), 0)).getDate();
	},

	// Year
	L: function () { // Is leap year?; 0 or 1
		var j = f.Y();
		return j % 4 === 0 & j % 100 !== 0 | j % 400 === 0;
	},
	o: function () { // ISO-8601 year
		var n = f.n(),
			W = f.W(),
			Y = f.Y();
		return Y + (n === 12 && W < 9 ? 1 : n === 1 && W > 9 ? -1 : 0);
	},
	Y: function () { // Full year; e.g. 1980...2010
		return jsdate.getFullYear();
	},
	y: function () { // Last two digits of year; 00...99
		return f.Y().toString().slice(-2);
	},

	// Time
	a: function () { // am or pm
		return jsdate.getHours() > 11 ? "pm" : "am";
	},
	A: function () { // AM or PM
	  return f.a().toUpperCase();
	},
	B: function () { // Swatch Internet time; 000..999
		var H = jsdate.getUTCHours() * 36e2,
		// Hours
			i = jsdate.getUTCMinutes() * 60,
			// Minutes
			s = jsdate.getUTCSeconds(); // Seconds
		return _pad(Math.floor((H + i + s + 36e2) / 86.4) % 1e3, 3);
	},
	g: function () { // 12-Hours; 1..12
		return f.G() % 12 || 12;
	},
	G: function () { // 24-Hours; 0..23
		return jsdate.getHours();
	},
	h: function () { // 12-Hours w/leading 0; 01..12
		return _pad(f.g(), 2);
	},
	H: function () { // 24-Hours w/leading 0; 00..23
		return _pad(f.G(), 2);
	},
	i: function () { // Minutes w/leading 0; 00..59
		return _pad(jsdate.getMinutes(), 2);
	},
	s: function () { // Seconds w/leading 0; 00..59
		return _pad(jsdate.getSeconds(), 2);
	},
	u: function () { // Microseconds; 000000-999000
		return _pad(jsdate.getMilliseconds() * 1000, 6);
	},

	// Timezone
	e: function () { // Timezone identifier; e.g. Atlantic/Azores, ...
		// The following works, but requires inclusion of the very large
		// timezone_abbreviations_list() function.
	/*              return that.date_default_timezone_get();
	*/
	  throw 'Not supported (see source code of date() for timezone on how to add support)';
	},
	I: function () { // DST observed?; 0 or 1
		// Compares Jan 1 minus Jan 1 UTC to Jul 1 minus Jul 1 UTC.
		// If they are not equal, then DST is observed.
		var a = new Date(f.Y(), 0),
			// Jan 1
			c = Date.UTC(f.Y(), 0),
			// Jan 1 UTC
			b = new Date(f.Y(), 6),
			// Jul 1
			d = Date.UTC(f.Y(), 6); // Jul 1 UTC
		return ((a - c) !== (b - d)) ? 1 : 0;
	},
	O: function () { // Difference to GMT in hour format; e.g. +0200
		var tzo = jsdate.getTimezoneOffset(),
			a = Math.abs(tzo);
		return (tzo > 0 ? "-" : "+") + _pad(Math.floor(a / 60) * 100 + a % 60, 4);
	},
	P: function () { // Difference to GMT w/colon; e.g. +02:00
		var O = f.O();
		return (O.substr(0, 3) + ":" + O.substr(3, 2));
	},
	T: function () { // Timezone abbreviation; e.g. EST, MDT, ...
	  // The following works, but requires inclusion of the very
	  // large timezone_abbreviations_list() function.
	/*              var abbr = '', i = 0, os = 0, default = 0;
	  if (!tal.length) {
	    tal = that.timezone_abbreviations_list();
	  }
	  if (that.php_js && that.php_js.default_timezone) {
	    default = that.php_js.default_timezone;
	    for (abbr in tal) {
	      for (i=0; i < tal[abbr].length; i++) {
	        if (tal[abbr][i].timezone_id === default) {
	          return abbr.toUpperCase();
	        }
	      }
	    }
	  }
	  for (abbr in tal) {
	    for (i = 0; i < tal[abbr].length; i++) {
	      os = -jsdate.getTimezoneOffset() * 60;
	      if (tal[abbr][i].offset === os) {
	        return abbr.toUpperCase();
	      }
	    }
	  }
	*/
		return 'UTC';
	},
	Z: function () { // Timezone offset in seconds (-43200...50400)
		return -jsdate.getTimezoneOffset() * 60;
	},

	// Full Date/Time
	c: function () { // ISO-8601 date.
		return 'Y-m-d\\TH:i:sP'.replace(formatChr, formatChrCb);
	},
	r: function () { // RFC 2822
		return 'D, d M Y H:i:s O'.replace(formatChr, formatChrCb);
	},
	U: function () { // Seconds since UNIX epoch
		return jsdate / 1000 | 0;
	}
	};
	this.date = function (format, timestamp) {
	that = this;
	jsdate = (timestamp === undefined ? new Date() : // Not provided
		(timestamp instanceof Date) ? new Date(timestamp) : // JS Date()
		new Date(timestamp * 1000) // UNIX timestamp (auto-convert to int)
	);
	return format.replace(formatChr, formatChrCb);
	};
	return this.date(format, timestamp);
}
function str_split_phone (string,split_length,charAc) {
	if (split_length === null) {
	split_length = 1;
	}
	if (string === null || split_length < 1) {
	return false;
	}
	string += '';
	var chunks = [],
	pos = 0,
	len = string.length;
	while (pos < len) {
		chunks.push(string.slice(pos, pos += split_length));
	}
	var text = "";
	$(chunks).each(function(x,y){
		text+=y+charAc;
	});
	text = text.substring(0,14);
	return text;
}

// ajax count message unread
$(document).ready(function(){
	$(".fancybox-img").fancybox();
	$.ajax({
		type:'POST',
		url: '/back-office/webmail/counMessageUnread',
		beforeSend:function(){
		},
		success:function(data){
			$("#countMessageUnread").html(data);
		},
		error:function(){},
	});
	$.get(webroot+'/common/ajaxGetCountMenu',function(res){
		var link = webroot+'/module/voirAcq?id='+res.acq.new.first;
		$(".nav .menuCountAcq").attr('href',link);
		$(".nav .menuCountAcq .menuCountAcqNew ").html(res.acq.new.count);
		$(".nav .menuCountAcq .menuCountAcqAttente").html(res.acq.attente.count);
		$(".nav .menuCountPropertyDecouverte").html(res.property.countDecouverte);
	});
	
	$.get(webroot+'/common/userLogin',function(res){
		if($('#box-user-login-immo').length > 0){
			$('#box-user-login-immo .user-count-user-online').html(res.countOnline);
		}
		if(!$.isEmptyObject(res.data)){
			$.each(res.data,function(){
				var classOnline = this.isOnline == 1 ? webroot+'/themes/admincp/img/16/02.png' : webroot+'/themes/admincp/img/16/01.png';
				var textOnline = this.isOnline == 1 ? 'Online' : 'Offline';
				//var html = '<li><a style="cursor:default" href="javascript:void(0)"><i class="icon-user"></i> '+this.profile.firstname+' '+this.profile.lastname+' <img style="float:right" src="'+classOnline+'" /></a></li>';
				var html = '<li><a style="cursor:default" href="javascript:void(0)"><i class="icon-user"></i> '+this.profile.firstname+' <img style="float:right" src="'+classOnline+'" /></a></li>';
				$('#box-user-login-immo .user-list-user').prepend(html);
			});
		}
	});
	$(".acquereursForm-modal-decauverte").fancybox({
		width:"80%",
	});
});