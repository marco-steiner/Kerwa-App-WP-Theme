/**
 * File skip-link-focus-fix.js.
 *
 * Helps with accessibility for keyboard only users.
 *
 * Learn more: https://git.io/vWdr2
 */
( function() {
	var isWebkit = navigator.userAgent.toLowerCase().indexOf( 'webkit' ) > -1,
	    isOpera  = navigator.userAgent.toLowerCase().indexOf( 'opera' )  > -1,
	    isIe     = navigator.userAgent.toLowerCase().indexOf( 'msie' )   > -1;

	if ( ( isWebkit || isOpera || isIe ) && document.getElementById && window.addEventListener ) {
		window.addEventListener( 'hashchange', function() {
			var id = location.hash.substring( 1 ),
				element;

			if ( ! ( /^[A-z0-9_-]+$/.test( id ) ) ) {
				return;
			}

			element = document.getElementById( id );

			if ( element ) {
				if ( ! ( /^(?:a|select|input|button|textarea)$/i.test( element.tagName ) ) ) {
					element.tabIndex = -1;
				}

				element.focus();
			}
		}, false );
	}
})();

/* overflow-color */
(function(e,t){typeof exports==="object"&&typeof module!=="undefined"?module.exports=t():typeof define==="function"&&define.amd?define(t):e.overflowColor=t()})(this,function(){"use strict";var a="data-oc";var u=void 0;var l=void 0;var d=void 0;var r=void 0;var o=void 0;var n=false;var t=function(){return window.requestAnimationFrame||window.webkitRequestAnimationFrame||window.mozRequestAnimationFrame||function(e){window.setTimeout(e,1e3/60)}}();var i=function e(t){if(d!==t){d=t;var o="html { background: "+d+"; }";if(!r){r=document.createElement("style");var n=document.head||document.getElementsByTagName("head")[0];n.appendChild(r)}if(r.styleSheet){r.styleSheet.cssText=o}else{r.innerHTML=o}}};var c=function e(){o=window.scrollY;if(!n&&(u||l)){t(function(){var e=document.body.scrollHeight;var t=window.innerHeight;if(e===t){i(l)}else{i(t-e+2*o<0?u:l)}n=false});n=true}};var s=function e(){u=null;l=null;var t=document.querySelector("["+a+"]");if(t){var o=t.getAttribute(a).split(",");if(o.length>1){u=o[0];l=o[1]}else if(o.length===1){u=l=o[0]}}else{var n=document.querySelector("["+a+"-top]");var d=document.querySelector("["+a+"-bottom]");if(n){u=n.getAttribute(a+"-top")}if(d){l=d.getAttribute(a+"-bottom")}}if(!u&&l){u=l}else if(u&&!l){l=u}var r=window.getComputedStyle(document.body,null);var i=r.getPropertyValue("background");if(i===""||r.getPropertyValue("background-color")==="rgba(0, 0, 0, 0)"&&i.substring(21,17)==="none"){i="white"}document.body.style.background="transparent";c()};var e=function e(){var t=window.getComputedStyle(document.body,null);var o=t.getPropertyValue("background");if(o===""||t.getPropertyValue("background-color")==="rgba(0, 0, 0, 0)"&&o.substring(21,17)==="none"){o="white"}document.body.style.background="transparent";var n=document.createElement("div");n.setAttribute(a+"-wrap","");n.style.background=o;for(var d=document.body.childNodes.length-1;d>0;d--){var r=document.body.childNodes[d];if(typeof r.getAttribute!=="function"||r.getAttribute(a+"-outside")===null){n.insertBefore(r,n.childNodes[0])}}if(document.body.childNodes.length){document.body.insertBefore(n,document.body.childNodes[0])}else{document.body.appendChild(n)}s();if(typeof window.addEventListener!=="undefined"){window.addEventListener("scroll",c,{passive:true});window.addEventListener("resize",c,{passive:true})}else{window.attachEvent("scroll",c);window.attachEvent("resize",c)}};if(["interactive","complete","loaded"].indexOf(document.readyState)!==-1){e()}else if(typeof document.addEventListener!=="undefined"){document.addEventListener("DOMContentLoaded",e,false)}else{document.attachEvent("onreadystatechange",e)}window.updateOverflowColor=s;return s});

/**
 * jQuery Accordion & Live Filter
 * ID of SearchInput = #liveSearchInput
 * Accordion Selector $('.accordion').accordionLiveFilter();
 */
$.fn.accordionLiveFilter = function() {

    return this.each(function() {
        
        var selector = $(this);
        var $filterField = $('#liveSearchInput');

        //var selector = $filterField.data('alf');
        if (!selector) {
            throw new Error('The accordion element needs a data-alf element with a jquery selector.');
        }

        var $accordion = $(selector);
        if ($accordion.length == 0) {
            throw new Error('The selector ' + selector + ' was not found.');
        }

        // X löschen im Suchfeld
        var $delete = $('<a href="#" class="searchDelete" style="display:none;">&times;</a>');
        $delete.on('click', function(e) {
            e.preventDefault();
            $filterField.val('');
            $('.searchDelete').hide();
            $('label', $accordion).trigger('contract.alf');
            $('li', $accordion).show();
        });
        $filterField.after($delete);


        $('label', $accordion).each(function(i, label) {
            var $label = $(label);
            var $ul = $label.next('ul');
            $label.data('alf-child', $ul);
            $ul.data('alf-parent', $label);
        });

        $('label', $accordion).on('expand.alf', function() {
            $(this).addClass('expanded').data('alf-child').slideDown();
        }).on('contract.alf', function() {
            $(this).removeClass('expanded').data('alf-child').slideUp();
        }).on('click', function() {
            var $label = $(this);
            $label.hasClass('expanded') ? $label.trigger('contract.alf') : $label.trigger('expand.alf');
        });

        $filterField.on('keyup', function() {
            var query = $filterField.val().toLowerCase();
            $('li > ul', $accordion).each(function(index, element) {
                var $ul = $(element);
                var $ulChildren = $ul.children();

                if (query) {
                    $('.searchDelete').show(); // X einblenden
                    $ulChildren.hide();
                    $ul.parent().hide(); // Hide Container with Label
                    var ulText = $ul.text();
                    var idx = ulText.toLowerCase().indexOf(query);
                    if (idx >= 0) {
                        $ulChildren.each(function(i, e) {
                            var $e = $(e);
                            if ($e.text().toLowerCase().indexOf(query) >= 0) {
                                $e.parent().parent().show(); // Show Container with Label
                                $e.show();
                            }
                        });
                        $ul.data('alf-parent').trigger('expand.alf');
                        return true;
                    }
                } else {
                    $('.searchDelete').hide();
                }
                $ul.data('alf-parent').trigger('contract.alf');
            });
        });
    });
};

/* ListSwipe */
$.fn.listSwipe = function (options) {
    var settings = $.extend({
        itemSelector: '>', //The item in the list that has the side actions
        itemActionWidth: 100, //In pixels
        leftAction: false, //Whether there is an action on the left
        rightAction: true, //Whether there is an action on the right
        snapThreshold: 0.8, //Percent threshold for snapping to position on touch end
        snapDuration: 200, //Snap animation duration
        closeOnOpen: true, //Close other item actions if a new one is moved
        maxYDelta: 40, //Number of pixels in the Y-axis before preventing swiping
        initialXDelta: 25 //Number of pixels in the X-axis before allowing swiping
    }, options);

    return this.each(function () {
        var $list = $(this);
        $list.on('touchstart', settings.itemSelector, function (e) {
            var $item = $(this);
            $item.stop();

            if (settings.closeOnOpen) {
                $list.find(settings.itemSelector).not($item).animate({
                    left: '0px'
                }, settings.snapDuration);
                speechSynthesis.cancel();
            }

            var touch = getTouchPosition(e);
            var rawStartLeft = $item.css('left');

            var data = {
                touchStart: touch,
                startLeft: rawStartLeft === 'auto' ? 0 : parseInt(rawStartLeft),
                initialXDeltaReached: false,
                maxYDeltaReached: false
            };

            $item.data('listSwipe', data);
        }).on('touchmove', settings.itemSelector, function (e) {
            var $item = $(this);
            var data = $item.data('listSwipe');
            var touch = getTouchPosition(e);

            if (data.maxYDeltaReached) {
                return;
            }

            var touchDelta = getTouchDelta(touch, data, settings);

            if (!data.maxYDeltaReached && Math.abs(touchDelta.yDelta) > settings.maxYDelta) {
                data.maxYDeltaReached = true;
                speechSynthesis.cancel();
                $item.animate({
                    left: '0px'
                }, settings.snapDuration);
            }
            else if (!data.initialXDeltaReached && Math.abs(touchDelta.xDelta) > settings.initialXDelta) {
                data.initialXDeltaReached = true;
                $item.css('left', touchDelta.xDelta + 'px');

            }
            else if (data.initialXDeltaReached) {
                $item.css('left', touchDelta.xDelta + 'px');
            }

            $item.data('listSwipe', data);

        }).on('touchend', settings.itemSelector, function (e) {
            var $item = $(this);
            var data = $item.data('listSwipe');
            var touch = getTouchPosition(e);

            if (data.maxYDeltaReached) {
                return;
            }

            var touchDelta = getTouchDelta(touch, data, settings);

            var xThreshold = Math.abs(touchDelta.xDelta) / settings.itemActionWidth;
            if (xThreshold >= settings.snapThreshold) {
                if (touchDelta.xDelta < 0) {
                    touchDelta.xDelta = -settings.itemActionWidth;
                }
                else {
                    touchDelta.xDelta = settings.itemActionWidth;
                }
            }
            else {
                touchDelta.xDelta = 0;
            }

            $item.animate({
                left: touchDelta.xDelta + 'px'
            }, settings.snapDuration);
        });
    });
};

function accordionLiveFilter () {
    $('.accordion').accordionLiveFilter();
}

function backToTop() {
    // Back to Top Button
    var back_to_top_button = ['<a href="#top" class="backToTop"><div class="arrow"><span></span><span></span></div></a>'].join("");
    $("body").append(back_to_top_button)

    // Der Button wird ausgeblendet
    $(".backToTop").hide();

    $(window).scroll(function () {
        if ($(this).scrollTop() > 500) { // Wenn 500 Pixel gescrolled wurde
            $('.backToTop').fadeIn();
        } else {
            $('.backToTop').fadeOut();
        }
    });

    $('.backToTop').click(function () { // Klick auf den Button
        $('body,html').animate({
            scrollTop: 0
        }, 200);
        return false;
    });
}

function checklistNumbering () {
    // checkList li Nummerierung
    $('.checkList').each(function(i) {
        $(this).children('li').each(function() {
            $(this).attr('id', 'checkItem'+i+'-'+ ($(this).index() +1));
        });
    });
}

function getTouchPosition(event) {
    return {
        x: event.changedTouches[0].clientX,
        y: event.changedTouches[0].clientY
    };
}

function getTouchDelta(touch, data, settings) {
    var xDelta = touch.x - data.touchStart.x + data.startLeft;
    var yDelta = touch.y - data.touchStart.y;

    if (!settings.rightAction && xDelta < 0) {
        xDelta = 0;
    }
    if (!settings.leftAction && xDelta > 0) {
        xDelta = 0;
    }
    return {
        xDelta: xDelta,
        yDelta: yDelta
    };
}

function initListSwipe () {
    $('.listSwipe').listSwipe();
}

function initLiveSearch () {
    $('.liveSearchList li').each(function() {
        $(this).find('.speakText').attr('data-search-term', $(this).find('.speakText').text().toLowerCase());
    });
}

function initMenu () {
    // overflow-color fix
    if ($(document).height() <= $(window).height()) {
        $('html').css('background', '#FFEE81');
    }

    $('nav [title]').removeAttr('title');
    $( '.navbar-toggler' ).click(function() {
        $( '.hamburger' ).toggleClass( 'is-active' );
    });
}

function saveToLocalStorage () {
    var setClass = JSON.parse(localStorage.getItem('setClass')) || {};
    if (setClass) {
        $.each(setClass, function () {
            $(this.selector).addClass(this.className);
        });
    }
    var addClassToLocalStorage = function(selector, className) {
        setClass[selector + ':' + className] = {
            selector: selector,
            className: className
        };
        localStorage.setItem('setClass', JSON.stringify(setClass));
    };
    var removeClassFromLocalStorage = function(selector, className) {
        delete setClass[selector + ':' + className];
        localStorage.setItem('setClass', JSON.stringify(setClass));
    };
    $('.like').on('click', function () {
        var accordionItem = '#' + $(this).parent().attr('id');
        if ( $(this).parent().hasClass('liked') ) {
            $(this).parent().removeClass('liked likeAni');
            removeClassFromLocalStorage(accordionItem, 'liked');
        } else {
            $(this).parent().addClass('liked likeAni');
            addClassToLocalStorage(accordionItem, 'liked');
        }
        addBestOfItems();
    });

    var addBestOfItems = function () {
        $('.bestof').empty();
        if ($.isEmptyObject(setClass) || (!setClass)) {
            $('.bestof').append('<li class="accordionItem">Du hast noch keine Lieblingslieder hinzugefügt. Tippe auf das Herz um Lieder als Lieblinge zu markieren.</li>');
        }
        $('.liked').each(function(){
            var newItem = $(this).clone(true).removeClass('liked');
                newItem.find('.like').remove();
            $('.bestof').append(newItem);
        });
    };
    addBestOfItems();

    $('.checkList li').on('click', function () {
        var checkItem = '#' + $(this).attr('id');
        if ( $(this).hasClass('checked') ) {
            $(this).removeClass('checked');
            removeClassFromLocalStorage(checkItem, 'checked');
        } else {
            $(this).addClass('checked');
            addClassToLocalStorage(checkItem, 'checked');
        }
    });
}

function shareButton () {
    // Mobile Native Share Menu (chrome/safari)
    var shareButton = $('.shareBtn');
    //var supported = document.getElementById('support');

    if (shareButton !== null) {
        // Listen for any clicks
        $('.shareBtn').on('click', function (e) {
            // Check if the current browser supports the Web Share API
            if (navigator.share !== undefined) {
                // Get the canonical URL from the link tag
                // var shareUrl = document.querySelector('link[rel=canonical]') ? document.querySelector('link[rel=canonical]').href : window.location.href;
                var shareTxt = $(this).parent().find('.speakText').text();

                // Share it!
                navigator.share({
                    //title: document.title,
                    //url: shareUrl,
                    text: shareTxt,
                });

                e.preventDefault();
            } else {
                //supported.innerHTML = "Unfortunately, this feature is not supported on your browser";
                // console.log('not supported');
            }
        });
    }
}    

function initSpeakerBot () {
    // Check for browser support
    if ('speechSynthesis' in window) {
        // support
    } else {
        $('.speak').hide();
    }

    // Get the voice select element.
    var voiceSelect = 'Microsoft Hedda Desktop - German';

    var sayTimeout = null;

    // Create a new utterance for the specified text and add it to the queue.
    function speak(text) {
    // Create a new instance of SpeechSynthesisUtterance.
        var msg = new SpeechSynthesisUtterance();
    
    // Set the text.
        msg.text = text;
    
    // Set the attributes.
        msg.volume = 1;
        msg.rate = 1.1;
        msg.pitch = 1;
    
    // If a voice has been selected, find the voice and set the utterance instance's voice attribute.
        msg.voice = speechSynthesis.getVoices().filter(function(voice) {
            //console.log(voice.name, voice.lang);
            return voice.name == voiceSelect;
        })[0];
        //console.log(msg.voice);

    // Queue this utterance.
        window.speechSynthesis.speak(msg);

        msg.onend = function(event) {
            $('.speakIcon .active').removeClass('active');
        }
    }

    // Set up an event listener for when the 'speak' button is clicked.
    $('.speak').click(function () {
        console.log('speak');
        var speakText = $(this).parent().find('.speakText').text();
        if (speechSynthesis.speaking) {
            // SpeechSyn is currently speaking, cancel the current utterance(s)
            speechSynthesis.cancel();
            $(this).find('span').removeClass('active');
    
            // Make sure we don't create more than one timeout...
            if (sayTimeout !== null)
                clearTimeout(sayTimeout);
    
            sayTimeout = setTimeout(function () { 
                speak(speakText);
            }, 150);
        }
        else {
            $(this).find('span').addClass('active');
            speak(speakText);
        }
    });
}



// Document Ready
$(function () {

    initMenu();
    initLiveSearch();
    initListSwipe();
    accordionLiveFilter();
    backToTop();
    checklistNumbering();
    saveToLocalStorage();
    shareButton();
    initSpeakerBot();

    // Speakerbot

    

});
// Document Ready End


// #FFD175 ORANGE
// #FFEE81 GELB

//OPEN TRIGGER
var openTrigger = $('.menu-trigger');
var openTriggerTop = openTrigger.find('.menu-trigger-bar.top');
var openTriggerMiddle = openTrigger.find('.menu-trigger-bar.middle');
var openTriggerBottom = openTrigger.find('.menu-trigger-bar.bottom');

//CLOSE TRIGGER
var closeTrigger = $('.close-trigger');
var closeTriggerLeft = closeTrigger.find('.close-trigger-bar.left');
var closeTriggerRight = closeTrigger.find('.close-trigger-bar.right');

//MENU
var menuContainer = $('.menu-container');
var menu = $('.menu');
var menuTop = $('.menu-bg.top');
var menuMiddle = $('.menu-bg.middle');
var menuBottom = $('.menu-bg.bottom');
var menuWrapper = $('.menu-wrapper');

//TL
var tlOpen = new TimelineMax({paused: true});
var tlClose = new TimelineMax({paused: true});

//OPEN TIMELINE
tlOpen.add("preOpen")

.to(menuWrapper, 0.4, {
	display: "block",
	ease: Power4.easeIn
}, "preOpen")

.to(openTriggerTop, 0.4, {
	x: "+80px", y: "-80px", delay: 0.1, ease: Power4.easeIn,onComplete: function() {
		closeTrigger.css('z-index','25');
	}
}, "preOpen")

.to(openTriggerMiddle, 0.4, {
	x: "+=80px", y: "-=80px", ease: Power4.easeIn, onComplete: function() {
		openTrigger.css('visibility','hidden');
	}
}, "preOpen")

.to(openTriggerBottom, 0.4, {
  	x: "+=80px", y: "-=80px", delay: 0.2, ease: Power4.easeIn
}, "preOpen")

.add("open", "-=0.4")

.to(menuTop, 0.8, {
	y: "13%",
	ease: Power4.easeInOut
}, "open")

.to(menuMiddle, 0.8, {
	scaleY: 1,
    ease: Power4.easeInOut, onComplete: function() {
		menuContainer.css('background','#FFEE81'); // new
	}
}, "open")

.to(menuBottom, 0.8, {
	y: "-114%",
	ease: Power4.easeInOut
}, "open")

.fromTo(menu, 0.6, {
  	y: 30, opacity: 0, visibility: 'hidden'
}, {
  	y: 0, opacity: 1, visibility: 'visible', ease: Power4.easeOut
}, "-=0.2")

.add("preClose", "-=0.8")

.to(closeTriggerLeft, 0.8, {
  	x: "-=100px", y: "+=100px", ease: Power4.easeOut
}, "preClose")

.to(closeTriggerRight, 0.8, {
  	x: "+=100px", y: "+=100px", delay: 0.2, ease: Power4.easeOut
}, "preClose")

.to(menuContainer, 0.5, {
	delay: 0.3,
	ease: Power4.easeIn
}, "preOpen");

//CLOSE TIMELINE
tlClose.add("close")

.to(menuTop, 0.2, {
	backgroundColor: "#FFD175", ease: Power4.easeInOut, onComplete: function() {
		closeTrigger.css('z-index','5');
		openTrigger.css('visibility','visible');
  	}
}, "close")

.to(menuMiddle, 0.2, {
  	backgroundColor: "#FFD175", ease: Power4.easeInOut
}, "close")

.to(menuBottom, 0.2, {
  	backgroundColor: "#FFD175", ease: Power4.easeInOut
}, "close")

.to(menu, 0.6, {
	y: 20, opacity: 0, ease: Power4.easeOut, onComplete: function() {
    	menu.css('visibility','hidden');
  	}
}, "close")

.to(menuTop, 0.8, {
  	y: "-113%",
  	ease: Power4.easeInOut
}, "close", "+=0.2")

.to(menuMiddle, 0.8, {
  	scaleY: 0,
  	ease: Power4.easeInOut
}, "close", "+=0.2")

.to(menuBottom, 0.8, {
	y: "23%",
	ease: Power4.easeInOut, onComplete: function() {
		menuTop.css('background-color','#FFEE81');
		menuMiddle.css('background-color','#FFEE81');
		menuBottom.css('background-color','#FFEE81');
	}
}, "close", "+=0.2")

.to(closeTriggerLeft, 0.2, {
  	x: "+=100px", y: "-=100px", ease: Power4.easeIn
}, "close")

.to(closeTriggerRight, 0.2, {
  	x: "-=100px", y: "-=100px", delay: 0.1, ease: Power4.easeIn
}, "close")

.to(openTriggerTop, 1, {
  	x: "-=80px", y: "+=80px", delay: 0.2, ease: Power4.easeOut
}, "close")

.to(openTriggerMiddle, 1, {
  	x: "-=80px", y: "+=80px", ease: Power4.easeOut
}, "close")

.to(openTriggerBottom, 1, {
  	x: "-=80px", y: "+=80px", delay: 0.1, ease: Power4.easeOut
}, "close")

.to(menuWrapper, 0.8, {
	delay: 0.1,
	display: "none", 
	ease: Power4.easeOut
}, "close");

//EVENTS
openTrigger.on('click', function(){
  	if(tlOpen.progress() < 1){
		tlOpen.play();
		$('body').css('overflow', 'hidden');
	} else {
		tlOpen.restart();
		$('body').css('overflow', 'hidden');
	}
});
       
closeTrigger.on('click', function(){
  	if(tlClose.progress() < 1){
        menuContainer.css('background','none'); // new
		tlClose.play();
		$('body').css('overflow', 'auto');
	} else {
        menuContainer.css('background','none'); // new
		tlClose.restart();
		$('body').css('overflow', 'auto');
	}
});


/*
var ptr;
document.addEventListener("DOMContentLoaded", function() {
    ptr = new PullToReload({ 
        'callback-loading': function(){
            setTimeout(function(){
                ptr.loadingEnd();
            }, 2000);
        }
    });
    
});

var PullToReload = function(optsUser) {
    var self = this;
    this.opts = {
        'refresh-element': 'beer2',
        'content-element': 'full-width-page-wrapper',
        'border-height': 0,
        height: 140,
        'font-size': '30px',
        threshold: 20,
        //'pre-content': '<div class="cup"><div></div><i class="bolha"></i><i class="bolha"></i><i class="bolha"></i><i class="bolha"></i><i class="bolha"></i><i class="bolha"></i><i class="bolha"></i><i class="bolha"></i><i class="bolha"></i><i class="bolha"></i><i class="bolha"></i><i class="bolha"></i><i class="bolha"></i><i class="bolha"></i><i class="bolha"></i><i class="bolha"></i><i class="bolha"></i><i class="bolha"></i><i class="bolha"></i><i class="bolha"></i><i class="bolha"></i><i class="bolha"></i><i class="bolha"></i><i class="bolha"></i><i class="bolha"></i><i class="bolha"></i><i class="bolha"></i><i class="bolha"></i><i class="bolha"></i></div>Loading...',
        'pre-content': '',
        'loading-content': '<div class="cup"><div></div><i class="bolha"></i><i class="bolha"></i><i class="bolha"></i><i class="bolha"></i><i class="bolha"></i><i class="bolha"></i><i class="bolha"></i><i class="bolha"></i><i class="bolha"></i><i class="bolha"></i><i class="bolha"></i><i class="bolha"></i><i class="bolha"></i><i class="bolha"></i><i class="bolha"></i><i class="bolha"></i><i class="bolha"></i><i class="bolha"></i><i class="bolha"></i><i class="bolha"></i><i class="bolha"></i><i class="bolha"></i><i class="bolha"></i><i class="bolha"></i><i class="bolha"></i><i class="bolha"></i><i class="bolha"></i><i class="bolha"></i><i class="bolha"></i></div>',
        'callback-loading': function() {
            setTimeout(function() {
                self.loadingEnd();
            }, 1000);
        }
    };
    for (var prop in self.opts) {
        if (optsUser[prop] !== undefined) {
            self.opts[prop] = optsUser[prop];
        }
    }
    this.ptr = document.querySelector('#' + self.opts['refresh-element']);
    this.content = document.querySelector('#' + self.opts['content-element']);
    this.ptr.style.padding = '0px';
    this.ptr.style.margin = '0px';
    this.ptr.style.display = 'block';
    this.ptr.style.height = self.opts.height + 'px';
    this.ptr.style.border = self.opts['border-height'] + 'px solid #000';
    this.ptr.style.borderTop = '0px';
    this.ptr.style.borderLeft = '0px';
    this.ptr.style.borderRight = '0px';
    this.ptr.style.textAlign = 'center';
    this.ptr.style.lineHeight = self.opts.height + 'px';
    this.ptr.style.fontSize = self.opts['font-size'];
    this.ptr.style.marginTop = '-' + (self.opts['border-height'] + self.opts.height) + 'px';
    this.ptr.style.opacity = '0';
    this.loadingStart = function() {
        this.ptr.innerHTML = self.opts['loading-content'];
        self.opts['callback-loading']();
    }
    ;
    this.loadingEnd = function() {
        this.ptr.innerHTML = self.opts['pre-content'];
        this.ptr.style.marginTop = '-' + (self.opts['border-height'] + self.opts.height + 'px');
    }
    ;
    this.getPageY = function(event) {
        if (event.pageY === undefined && event.touches !== undefined) {
            if (event.touches.length <= 0) {
                return false;
            }
            event.pageY = event.touches[event.touches.length - 1].pageY;
        }
        return event.pageY;
    }
    ;
    this.isDragging = false;
    this.isThresholdReached = false;
    this.posStart = 0;
    self.content.addEventListener('touchstart', function(event) {
        self.mouseStart(event);
    });
    self.content.addEventListener('mousedown', function(event) {
        self.mouseStart(event);
    });
    this.mouseStart = function(event) {
        if (document.body.scrollTop >= self.content.getBoundingClientRect().top) {
            return;
        }
        self.isDragging = true;
        self.isThresholdReached = false;
        self.posStart = self.getPageY(event);
    }
    ;
    document.addEventListener('touchmove', function(event) {
        self.mouseMove(event);
    });
    document.addEventListener('mousemove', function(event) {
        self.mouseMove(event);
    });
    this.mouseMove = function(event) {
        if (document.body.scrollTop >= self.content.getBoundingClientRect().top) {
            return;
        }
        if (!self.isDragging) {
            return;
        }
        event.pageY = self.getPageY(event);
        if (event.pageY === false) {
            return;
        }
        var dragDistance = (event.pageY - self.posStart);
        if (dragDistance <= 0) {
            return;
        }
        //event.preventDefault();
        event.stopImmediatePropagation();
        var newMargin = (self.opts['border-height'] + (self.opts.height - dragDistance));
        //console.log('height: ',self.opts.height);
        //console.log('dragDistance: ',dragDistance);
        //console.log('newMargin: ',newMargin);
        //console.log('scrolltop: ',document.body.scrollTop);
        var newOpacity = (((1 - (self.opts.height - document.body.scrollTop) / self.opts.height) * 0.8) + 0.2);
        if (newMargin <= 0) {
            return;
        }
        if (newMargin <= self.opts.threshold) {
            self.isThresholdReached = true;
        }
        self.ptr.style.marginTop = '-' + (newMargin + 'px');
        //self.ptr.style.opacity = '-' + (newOpacity);
    }
    ;
    document.addEventListener('touchend', function(event) {
        self.mouseEnd(event);
    });
    document.addEventListener('mouseup', function(event) {
        self.mouseEnd(event);
    });
    this.mouseEnd = function(event) {
        if (document.body.scrollTop >= self.content.getBoundingClientRect().top) {
            return;
        }
        if (!self.isDragging) {
            return;
        }
        //event.preventDefault();
        event.stopImmediatePropagation();
        if (self.isThresholdReached) {
            self.ptr.style.marginTop = '0px';
            self.isDragging = false;
            self.isThresholdReached = false;
            self.loadingStart();
            return;
        }
        self.ptr.style.marginTop = '-' + (self.opts['border-height'] + self.opts.height + 'px');
        self.isDragging = false;
        self.isThresholdReached = false;
    }
    ;
};

*/

