/**
 * @file
 * Cherries by @toddmotto, @cferdinandi, @adamfschwartz, @daniellmb.
 *
 * @todo: Use Cash or Underscore when jQuery is dropped by supported plugins.
 */

/* global define, module */
(function (root, factory) {

  'use strict';

  // Inspired by https://github.com/addyosmani/memoize.js/blob/master/memoize.js
  if (typeof define === 'function' && define.amd) {
    // AMD. Register as an anonymous module.
    define([], factory);
  }
  else if (typeof exports === 'object') {
    // Node. Does not work with strict CommonJS, but only CommonJS-like
    // environments that support module.exports, like Node.
    module.exports = factory();
  }
  else {
    // Browser globals (root is window).
    root.dBlazy = factory();
  }
})(this, function () {

  'use strict';

  /**
   * Object for public APIs where dBlazy stands for drupalBlazy.
   *
   * @namespace
   */
  var dBlazy = {};

  // See https://developer.mozilla.org/en-US/docs/Web/API/Element/closest
  if (!Element.prototype.matches) {
    Element.prototype.matches = Element.prototype.msMatchesSelector || Element.prototype.webkitMatchesSelector;
  }

  /**
   * Check if the given element matches the selector.
   *
   * @name dBlazy.matches
   *
   * @param {Element} elem
   *   The current element.
   * @param {String} selector
   *   Selector to match against (class, ID, data attribute, or tag).
   *
   * @return {Boolean}
   *   Returns true if found, else false.
   *
   * @see http://caniuse.com/#feat=matchesselector
   * @see https://developer.mozilla.org/en-US/docs/Web/API/Element/matches
   */
  dBlazy.matches = function (elem, selector) {
    // Check if matches, excluding HTMLDocument, see ::closest().
    if (elem.matches(selector)) {
      return true;
    }

    return false;
  };

  /**
   * Returns device pixel ratio.
   *
   * @return {Integer}
   *   Returns the device pixel ratio.
   */
  dBlazy.pixelRatio = function () {
    return window.devicePixelRatio || 1;
  };

  /**
   * Returns cross-browser window width.
   *
   * @return {Integer}
   *   Returns the window width.
   */
  dBlazy.windowWidth = function () {
    return window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth || window.screen.width;
  };

  /**
   * Returns data from the current active window.
   *
   * When being resized, the browser gave no data about pixel ratio from desktop
   * to mobile, not vice versa. Unless delayed for 4s+, not less, which is of
   * course unacceptable.
   *
   * @name dBlazy.activeWidth
   *
   * @param {Object} dataset
   *   The dataset object must be keyed by window width.
   * @param {Boolean} mobileFirst
   *   Whether to use min-width, or max-width.
   *
   * @return {mixed}
   *   Returns data from the current active window.
   */
  dBlazy.activeWidth = function (dataset, mobileFirst) {
    var me = this;
    var keys = Object.keys(dataset);
    var xs = keys[0];
    var xl = keys[keys.length - 1];
    var pr = (me.windowWidth() * me.pixelRatio());
    var ww = mobileFirst ? me.windowWidth() : pr;
    var mw = function (w) {
      // The picture wants <= (approximate), non-picture wants >=, wtf.
      return mobileFirst ? parseInt(w) <= ww : parseInt(w) >= ww;
    };

    var data = keys.filter(mw).map(function (v) {
      return dataset[v];
    })[mobileFirst ? 'pop' : 'shift']();

    return typeof data === 'undefined' ? dataset[ww >= xl ? xl : xs] : data;
  };

  /**
   * Check if the HTML tag matches a specified string.
   *
   * @name dBlazy.equal
   *
   * @param {Element} el
   *   The element to compare.
   * @param {String} str
   *   HTML tag to match against.
   *
   * @return {Boolean}
   *   Returns true if matches, else false.
   */
  dBlazy.equal = function (el, str) {
    return el !== null && el.nodeName.toLowerCase() === str;
  };

  /**
   * Get the closest matching element up the DOM tree.
   *
   * Inspired by Chris Ferdinandi, http://github.com/cferdinandi/smooth-scroll.
   *
   * @name dBlazy.closest
   *
   * @param {Element} el
   *   Starting element.
   * @param {String} selector
   *   Selector to match against (class, ID, data attribute, or tag).
   *
   * @return {Boolean|Element}
   *   Returns null if not match found.
   *
   * @see http://caniuse.com/#feat=element-closest
   * @see http://caniuse.com/#feat=matchesselector
   * @see https://developer.mozilla.org/en-US/docs/Web/API/Element/matches
   */
  dBlazy.closest = function (el, selector) {
    var parent;
    while (el) {
      parent = el.parentElement;
      if (parent && parent.matches(selector)) {
        return parent;
      }
      el = parent;
    }

    return null;
  };

  /**
   * Returns a new object after merging two, or more objects.
   *
   * Inspired by @adamfschwartz, @zackbloom, http://youmightnotneedjquery.com.
   *
   * @name dBlazy.extend
   *
   * @param {Object} out
   *   The objects to merge together.
   *
   * @return {Object}
   *   Merged values of defaults and options.
   */
  dBlazy.extend = Object.assign || function (out) {
    out = out || {};

    for (var i = 1, len = arguments.length; i < len; i++) {
      if (!arguments[i]) {
        continue;
      }

      for (var key in arguments[i]) {
        if (Object.prototype.hasOwnProperty.call(arguments[i], key)) {
          out[key] = arguments[i][key];
        }
      }
    }

    return out;
  };

  /**
   * A simple forEach() implementation for Arrays, Objects and NodeLists.
   *
   * @name dBlazy.forEach
   *
   * @author Todd Motto
   * @link https://github.com/toddmotto/foreach
   *
   * @param {Array|Object|NodeList} collection
   *   Collection of items to iterate.
   * @param {Function} callback
   *   Callback function for each iteration.
   * @param {Array|Object|NodeList} scope
   *   Object/NodeList/Array that forEach is iterating over (aka `this`).
   */
  dBlazy.forEach = function (collection, callback, scope) {
    var proto = Object.prototype;
    if (proto.toString.call(collection) === '[object Object]') {
      for (var prop in collection) {
        if (proto.hasOwnProperty.call(collection, prop)) {
          callback.call(scope, collection[prop], prop, collection);
        }
      }
    }
    else if (collection) {
      for (var i = 0, len = collection.length; i < len; i++) {
        callback.call(scope, collection[i], i, collection);
      }
    }
  };

  /**
   * A simple hasClass wrapper.
   *
   * @name dBlazy.hasClass
   *
   * @param {Element} el
   *   The HTML element.
   * @param {String} name
   *   The class name.
   *
   * @return {bool}
   *   True if of of the method is supported.
   *
   * @todo remove for el.classList.contains() alone.
   */
  dBlazy.hasClass = function (el, name) {
    if (el.classList) {
      return el.classList.contains(name);
    }
    else {
      return el.className.indexOf(name) !== -1;
    }
  };

  /**
   * A simple attributes wrapper.
   *
   * @name dBlazy.setAttr
   *
   * @param {Element} el
   *   The HTML element.
   * @param {String} attr
   *   The attr name.
   * @param {Boolean} remove
   *   True if should remove.
   */
  dBlazy.setAttr = function (el, attr, remove) {
    if (el.hasAttribute('data-' + attr)) {
      var dataAttr = el.getAttribute('data-' + attr);
      if (attr === 'src') {
        el.src = dataAttr;
      }
      else {
        el.setAttribute(attr, dataAttr);
      }

      if (remove) {
        el.removeAttribute('data-' + attr);
      }
    }
  };

  /**
   * A simple attributes wrapper looping based on the given attributes.
   *
   * @name dBlazy.setAttrs
   *
   * @param {Element} el
   *   The HTML element.
   * @param {Array} attrs
   *   The attr names.
   * @param {Boolean} remove
   *   True if should remove.
   */
  dBlazy.setAttrs = function (el, attrs, remove) {
    var me = this;

    me.forEach(attrs, function (src) {
      me.setAttr(el, src, remove);
    });
  };

  /**
   * A simple attributes wrapper, looping based on sources (picture/ video).
   *
   * @name dBlazy.setAttrsWithSources
   *
   * @param {Element} el
   *   The starting HTML element.
   * @param {String} attr
   *   The attr name, can be SRC or SRCSET.
   * @param {Boolean} remove
   *   True if should remove.
   */
  dBlazy.setAttrsWithSources = function (el, attr, remove) {
    var me = this;
    var parent = el.parentNode || null;
    var isPicture = parent && me.equal(parent, 'picture');
    var targets = isPicture ? parent.getElementsByTagName('source') : el.getElementsByTagName('source');

    attr = attr || (isPicture ? 'srcset' : 'src');

    if (targets.length) {
      me.forEach(targets, function (source) {
        me.setAttr(source, attr, remove);
      });
    }
  };

  /**
   * Updates CSS background with multi-breakpoint images.
   *
   * @name dBlazy.updateBg
   *
   * @param {Element} el
   *   The container HTML element.
   * @param {Boolean} mobileFirst
   *   Whether to use min-width or max-width.
   */
  dBlazy.updateBg = function (el, mobileFirst) {
    var me = this;
    var backgrounds = me.parse(el.getAttribute('data-backgrounds'));

    if (backgrounds) {
      var bg = me.activeWidth(backgrounds, mobileFirst);
      if (bg && bg !== 'undefined') {
        el.style.backgroundImage = 'url("' + bg.src + '")';

        // Allows to disable Aspect ratio if it has known/ fixed heights such as
        // gridstack multi-size boxes.
        if (bg.ratio && !el.classList.contains('b-noratio')) {
          el.style.paddingBottom = bg.ratio + '%';
        }
      }
    }
  };

  /**
   * A simple removeAttribute wrapper.
   *
   * @name dBlazy.removeAttrs
   *
   * @param {Element} el
   *   The HTML element.
   * @param {Array} attrs
   *   The attr names.
   */
  dBlazy.removeAttrs = function (el, attrs) {
    this.forEach(attrs, function (attr) {
      el.removeAttribute('data-' + attr);
    });
  };

  /**
   * A simple wrapper for event delegation like jQuery.on().
   *
   * Inspired by http://stackoverflow.com/questions/30880757/
   * javascript-equivalent-to-on.
   *
   * @name dBlazy.on
   *
   * @param {Element} elm
   *   The parent HTML element.
   * @param {String} eventName
   *   The event name to trigger.
   * @param {String} childEl
   *   Child selector to match against (class, ID, data attribute, or tag).
   * @param {Function} callback
   *   The callback function.
   *
   * @see https://developer.mozilla.org/en-US/docs/Web/API/EventTarget/addEventListener
   */
  dBlazy.on = function (elm, eventName, childEl, callback) {
    elm.addEventListener(eventName, function (event) {
      var t = event.target;
      event.delegateTarget = elm;
      while (t && t !== this) {
        if (dBlazy.matches(t, childEl)) {
          callback.call(t, event);
        }
        t = t.parentNode;
      }
    });
  };

  /**
   * A simple wrapper for addEventListener.
   *
   * Made public from original bLazy library.
   *
   * @name dBlazy.bindEvent
   *
   * @param {Element} el
   *   The HTML element.
   * @param {String} type
   *   The event name to add.
   * @param {Function} fn
   *   The callback function.
   * @param {Object} params
   *   The optional param passed into a custom event.
   *
   * @see https://developer.mozilla.org/en-US/docs/Web/API/EventTarget/addEventListener
   * @todo remove old IE references after another check.
   */
  dBlazy.bindEvent = function (el, type, fn, params) {
    var defaults = {capture: false, passive: true};
    var extraParams = params ? this.extend(defaults, params) : defaults;
    if (el.attachEvent) {
      el.attachEvent('on' + type, fn, extraParams);
    }
    else {
      el.addEventListener(type, fn, extraParams);
    }
  };

  /**
   * A simple wrapper for removeEventListener.
   *
   * Made public from original bLazy library.
   *
   * @name dBlazy.unbindEvent
   *
   * @param {Element} el
   *   The HTML element.
   * @param {String} type
   *   The event name to remove.
   * @param {Function} fn
   *   The callback function.
   * @param {Object} params
   *   The optional param passed into a custom event.
   *
   * @see https://developer.mozilla.org/en-US/docs/Web/API/EventTarget/removeEventListener
   * @todo remove old IE references after another check.
   */
  dBlazy.unbindEvent = function (el, type, fn, params) {
    var defaults = {capture: false, passive: true};
    var extraParams = params ? this.extend(defaults, params) : defaults;
    if (el.detachEvent) {
      el.detachEvent('on' + type, fn, extraParams);
    }
    else {
      el.removeEventListener(type, fn, extraParams);
    }
  };

  /**
   * Executes a function once.
   *
   * @name dBlazy.once
   *
   * @author Daniel Lamb <dlamb.open.source@gmail.com>
   * @link https://github.com/daniellmb/once.js
   *
   * @param {Function} fn
   *   The executed function.
   *
   * @return {Object}
   *   The function result.
   */
  dBlazy.once = function (fn) {
    var result;
    var ran = false;
    return function proxy() {
      if (ran) {
        return result;
      }
      ran = true;
      result = fn.apply(this, arguments);
      // For garbage collection.
      fn = null;
      return result;
    };
  };

  /**
   * A simple wrapper for JSON.parse() for string within data-* attributes.
   *
   * @name dBlazy.parse
   *
   * @param {String} str
   *   The string to convert into JSON object.
   *
   * @return {Object|Boolean}
   *   The JSON object, or false in case invalid.
   */
  dBlazy.parse = function (str) {
    try {
      return JSON.parse(str);
    }
    catch (e) {
      return false;
    }
  };

  /**
   * A simple wrapper to animate anything using animate.css.
   *
   * @name dBlazy.animate
   *
   * @param {Element} el
   *   The animated HTML element.
   * @param {String} animation
   *   Any custom animation name, fallbacks to [data-animation].
   */
  dBlazy.animate = function (el, animation) {
    var me = this;
    var props = [
      'animation',
      'animation-duration',
      'animation-delay',
      'animation-iteration-count'
    ];

    animation = animation || el.dataset.animation;
    el.classList.add('animated', animation);
    me.forEach(['Duration', 'Delay', 'IterationCount'], function (key) {
      if ('animation' + key in el.dataset) {
        el.style['animation' + key] = el.dataset['animation' + key];
      }
    });

    function animationEnd() {
      me.removeAttrs(el, props);

      el.classList.add('is-b-animated');
      el.classList.remove('animated', animation);

      me.forEach(props, function (key) {
        el.style.removeProperty(key);
      });

      me.unbindEvent(el, 'animationend', animationEnd);
    }

    me.bindEvent(el, 'animationend', animationEnd);
  };

  /**
   * A simple wrapper to delay callback function, taken out of blazy library.
   *
   * Alternative to core Drupal.debounce for D7 compatibility, and easy port.
   *
   * @name dBlazy.throttle
   *
   * @param {Function} fn
   *   The callback function.
   * @param {Int} minDelay
   *   The execution delay in milliseconds.
   * @param {Object} scope
   *   The scope of the function to apply to, normally this.
   *
   * @return {Function}
   *   The function executed at the specified minDelay.
   */
  dBlazy.throttle = function (fn, minDelay, scope) {
    var lastCall = 0;
    return function () {
      var now = +new Date();
      if (now - lastCall < minDelay) {
        return;
      }
      lastCall = now;
      fn.apply(scope, arguments);
    };
  };

  /**
   * A simple wrapper to delay callback function on window resize.
   *
   * @name dBlazy.resize
   *
   * @link https://github.com/louisremi/jquery-smartresize
   *
   * @param {Function} c
   *   The callback function.
   * @param {Int} t
   *   The timeout.
   *
   * @return {Function}
   *   The callback function.
   */
  dBlazy.resize = function (c, t) {
    window.onresize = function () {
      window.clearTimeout(t);
      t = window.setTimeout(c, 200);
    };
    return c;
  };

  /**
   * A simple wrapper for triggering event like jQuery.trigger().
   *
   * @name dBlazy.trigger
   *
   * @param {Element} elm
   *   The HTML element.
   * @param {String} eventName
   *   The event name to trigger.
   * @param {Object} custom
   *   The optional object passed into a custom event.
   * @param {Object} param
   *   The optional param passed into a custom event.
   *
   * @see https://developer.mozilla.org/en-US/docs/Web/Guide/Events/Creating_and_triggering_events
   * @todo: See if any consistent way for both custom and native events.
   */
  dBlazy.trigger = function (elm, eventName, custom, param) {
    var event;
    var data = {
      detail: custom || {}
    };

    if (typeof param === 'undefined') {
      data.bubbles = true;
      data.cancelable = true;
    }

    // Native.
    // IE >= 9 compat, else SCRIPT445: Object doesn't support this action.
    // https://msdn.microsoft.com/library/ff975299(v=vs.85).aspx
    if (typeof window.CustomEvent === 'function') {
      event = new CustomEvent(eventName, data);
    }
    else {
      event = document.createEvent('CustomEvent');
      event.initCustomEvent(eventName, true, true, data);
    }

    elm.dispatchEvent(event);
  };

  return dBlazy;

});
;
/**
 * @file
 * Provides Intersection Observer API, or bLazy loader.
 */

(function (Drupal, drupalSettings, _db, window, document) {

  'use strict';

  var _dataAnimation = 'data-animation';
  var _dataDimensions = 'data-dimensions';
  var _dataBg = 'data-backgrounds';
  var _dataRatio = 'data-ratio';
  var _firstBlazy = 'blazy--first';
  var _isNativeExecuted = false;
  var _isPictureExecuted = false;
  var _resizeTick = 0;

  /**
   * Blazy public methods.
   *
   * @namespace
   */
  Drupal.blazy = Drupal.blazy || {
    context: null,
    init: null,
    items: [],
    ratioItems: [],
    windowWidth: 0,
    blazySettings: drupalSettings.blazy || {},
    ioSettings: drupalSettings.blazyIo || {},
    revalidate: false,
    options: {},
    globals: function () {
      var me = this;
      var commons = {
        isUniform: false,
        success: me.clearing.bind(me),
        error: me.clearing.bind(me),
        selector: '.b-lazy',
        errorClass: 'b-error',
        successClass: 'b-loaded'
      };

      return _db.extend(me.blazySettings, me.ioSettings, commons);
    },

    clearing: function (el) {
      var me = this;
      var cn = _db.closest(el, '.media');
      var an = _db.closest(el, '[' + _dataAnimation + ']');

      // Clear loading classes.
      me.clearLoading(el);

      // Reevaluate the element.
      me.reevaluate(el);

      // Container might be the el itself for BG, do not NULL check here.
      me.updateContainer(el, cn);

      // Supports blur, animate.css for CSS background, picture, image, media.
      if (an !== null || me.has(el, _dataAnimation)) {
        _db.animate(an !== null ? an : el);
      }

      // Provides event listeners for easy overrides without full overrides.
      _db.trigger(el, 'blazy.done', {options: me.options});

      // Initializes the native lazy loading once the first found is loaded.
      if (!_isNativeExecuted) {
        _db.trigger(me.context, 'blazy.native', {options: me.options});

        _isNativeExecuted = true;
      }
    },

    clearLoading: function (el) {
      // The .b-lazy element can be attached to IMG, or DIV as CSS background.
      // The .(*)loading can be .media, .grid, .slide__content, .box, etc.
      var loaders = [
        el,
        _db.closest(el, '.is-loading'),
        _db.closest(el, '[class*="loading"]')
      ];

      _db.forEach(loaders, function (loader) {
        if (loader !== null) {
          loader.className = loader.className.replace(/(\S+)loading/, '');
        }
      });
    },

    isLoaded: function (el) {
      return el !== null && el.classList.contains(this.options.successClass);
    },

    reevaluate: function (el) {
      var me = this;
      var ie = el.classList.contains('b-responsive') && el.hasAttribute('data-pfsrc');

      // In case an error, try forcing it.
      if (me.init !== null && _db.hasClass(el, me.options.errorClass)) {
        el.classList.remove(me.options.errorClass);

        // This is a rare case, hardly called, just nice to have for errors.
        window.setTimeout(function () {
          me.init.load(el);
        }, 10);
      }

      // @see http://scottjehl.github.io/picturefill/
      if (window.picturefill && ie) {
        window.picturefill({
          reevaluate: true,
          elements: [el]
        });
      }
    },

    has: function (el, attribute) {
      return el !== null && el.hasAttribute(attribute);
    },

    contains: function (el, name) {
      return el !== null && el.classList.contains(name);
    },

    updateContainer: function (el, cn) {
      var me = this;
      var isPicture = _db.equal(el.parentNode, 'picture') && me.has(cn, _dataDimensions);

      // Fixed for effect Blur messes up Aspect ratio Fluid calculation.
      window.setTimeout(function () {
        if (me.isLoaded(el)) {
          // Adds context for effetcs: blur, etc. considering BG, or just media.
          (me.contains(cn, 'media') ? cn : el).classList.add('is-b-loaded');

          if (isPicture) {
            me.updatePicture(el, cn);
          }

          if (me.has(el, _dataBg)) {
            _db.updateBg(el, me.options.mobileFirst);
          }
        }
      });
    },

    updatePicture: function (el, cn) {
      var me = this;
      var pad = Math.round(((el.naturalHeight / el.naturalWidth) * 100), 2);

      cn.style.paddingBottom = pad + '%';

      // Swap all aspect ratio once to reduce abrupt ratio changes for the rest.
      if (!_isPictureExecuted) {
        _db.trigger(me.context, 'blazy.uniform', {pad: pad});
        _isPictureExecuted = true;
      }
    },

    /**
     * Updates the dynamic multi-breakpoint aspect ratio: bg, picture or image.
     *
     * This only applies to Responsive images with aspect ratio fluid.
     * Static ratio (media--ratio--169, etc.) is ignored and uses CSS instead.
     *
     * @param {HTMLElement} cn
     *   The .media--ratio--fluid container HTML element.
     */
    updateRatio: function (cn) {
      var me = this;
      var dimensions = _db.parse(cn.getAttribute(_dataDimensions)) || ('dimensions' in me.options ? me.options.dimensions : false);

      if (!dimensions) {
        me.updateFallbackRatio(cn);
        return;
      }

      // For picture, this is more a dummy space till the image is downloaded.
      var isPicture = cn.querySelector('picture') !== null && _resizeTick > 0;
      var pad = _db.activeWidth(dimensions, isPicture);

      if (pad !== 'undefined') {
        cn.style.paddingBottom = pad + '%';
      }

      // Fix for picture or bg element with resizing.
      if (_resizeTick > 0 && (isPicture || me.has(cn, _dataBg))) {
        me.updateContainer((isPicture ? cn.querySelector('img') : cn), cn);
      }
    },

    updateFallbackRatio: function (cn) {
      // Only rewrites if the style is indeed stripped out by Twig, and not set.
      if (!cn.hasAttribute('style') && cn.hasAttribute(_dataRatio)) {
        cn.style.paddingBottom = cn.getAttribute(_dataRatio) + '%';
      }
    },

    doNativeLazy: function () {
      var me = this;
      var doNative = function (el) {
        // Reset attributes, and let supportive browsers lazy load natively.
        _db.setAttrs(el, ['srcset', 'src'], true);

        // Also supports PICTURE or (future) VIDEO which contains SOURCEs.
        _db.setAttrsWithSources(el, false, true);

        // Mark it loaded to prevent Blazy/IO to do any further work.
        el.classList.add(me.options.successClass);
        me.clearing(el);
      };

      var onNative = function () {
        _db.forEach(me.items, doNative);
      };

      _db.bindEvent(me.context, 'blazy.native', onNative, {once: true});
    },

    isNativeLazy: function () {
      return 'loading' in HTMLImageElement.prototype;
    },

    isIo: function () {
      return this.ioSettings && this.ioSettings.enabled && 'IntersectionObserver' in window;
    },

    isBlazy: function () {
      return !this.isIo() && 'Blazy' in window;
    },

    forEach: function (context) {
      var el = context.querySelector('[data-blazy]');
      var blazies = context.querySelectorAll('.blazy:not(.blazy--on)');

      // Various use cases: w/o formaters, custom, or basic, and mixed.
      // The [data-blazy] is set by the module for formatters, or Views gallery.
      if (blazies.length > 0) {
        _db.forEach(blazies, doBlazy, context);
      }

      // Runs basic Blazy if no [data-blazy] found, probably a single image or
      // a theme that does not use field attributes, or (non-grid) BlazyFilter.
      if (el === null) {
        initBlazy(context);
      }
    },

    run: function (opts) {
      return this.isIo() ? new BioMedia(opts) : new Blazy(opts);
    },

    afterInit: function (context) {
      var me = this;
      me.ratioItems = context.querySelector('.media--ratio') === null ? [] : context.querySelectorAll('.media--ratio');
      var shouldLoop = me.ratioItems.length > 0;

      var swapRatio = function (e) {
        var pad = e.detail.pad;

        if (pad > 10) {
          _db.forEach(me.ratioItems, function (cn) {
            cn.style.paddingBottom = pad + '%';
          }, context);
        }
      };

      var checkRatio = function () {
        me.windowWidth = _db.windowWidth();

        if (shouldLoop) {
          _db.forEach(me.ratioItems, me.updateRatio.bind(me), context);
        }

        // BC with bLazy, native/IO doesn't need to revalidate, bLazy does.
        // Scenarios: long horizontal containers, Slick carousel slidesToShow >
        // 3. If any issue, add a class `blazy--revalidate` manually to .blazy.
        if (!me.isNativeLazy() && (me.isBlazy() || me.revalidate)) {
          me.init.revalidate(true);
        }

        // Provides event listeners for easy overrides without full overrides.
        // Checks for weird contexts, in case spit out during AJAX, etc.
        if (context.classList && context.classList.contains(_firstBlazy)) {
          _db.trigger(context, 'blazy.afterInit', {
            items: me.items || me.ratioItems,
            windowWidth: me.windowWidth
          });
        }
        _resizeTick++;
      };

      // Checks for aspect ratio, onload event is a bit later.
      // @todo use Drupal.debounce if it makes any difference.
      checkRatio();
      _db.bindEvent(window, 'resize', Drupal.debounce(checkRatio, 200, true));

      // Reduces abrupt ratio changes for the rest after the first loaded.
      if (me.options.isUniform && shouldLoop) {
        _db.bindEvent(context, 'blazy.uniform', swapRatio, {once: true});
      }
    }

  };

  /**
   * Initialize the blazy instance, either basic, advanced, or native.
   *
   * The initialization may take once for basic (not using module formatters),
   * or per .blazy/[data-blazy] formatter when there are one or many on a page.
   *
   * @param {HTMLElement} context
   *   This can be document, or .blazy container w/o [data-blazy].
   * @param {Object} opts
   *   The options might be empty for basic blazy, not using formatters.
   */
  var initBlazy = function (context, opts) {
    var me = Drupal.blazy;
    // Set docroot in case we are in an iframe.
    var documentElement = context instanceof HTMLDocument ? context : _db.closest(context, 'html');

    opts = opts || {};
    opts.mobileFirst = opts.mobileFirst || false;
    documentElement = documentElement || document;
    if (!document.documentElement.isSameNode(documentElement)) {
      opts.root = documentElement;
    }

    me.options = _db.extend({}, me.globals(), opts);
    me.context = context;

    // Old bLazy, not IO, might need scrolling CSS selector like Modal library.
    // A scrolling modal with an iframe like Entity Browser has no issue since
    // the scrolling container is the entire DOM. Another use case is parallax.
    var scrollElms = '#drupal-modal, .is-b-scroll';
    if (me.options.container) {
      scrollElms += ', ' + me.options.container.trim();
    }
    me.options.container = scrollElms;

    // Swap lazy attributes to let supportive browsers lazy load them.
    // This means Blazy and even IO should not lazy-load them any more.
    // Ensures to not touch lazy-loaded AJAX, or likely non-supported elements:
    // Video, DIV, etc. Only IMG and IFRAME are supported for now.
    var nativeSelector = me.options.selector + '[loading]:not(.' + me.options.successClass + ')';
    me.items = documentElement.querySelector(nativeSelector) === null ? [] : documentElement.querySelectorAll(nativeSelector);
    if (me.isNativeLazy()) {
      // Intentionally on the second line to not hit it till verified.
      if (me.items.length > 0) {
        me.doNativeLazy();
      }
    }

    // Put the blazy/IO instance into a public object for references/ overrides.
    // If native lazy load is supported, the following will skip internally.
    me.init = me.run(me.options);

    // Reacts on resizing per 200ms.
    me.afterInit(context);
  };

  /**
   * Blazy utility functions.
   *
   * @param {HTMLElement} elm
   *   The .blazy/[data-blazy] container, not the lazyloaded .b-lazy element.
   */
  function doBlazy(elm) {
    var me = Drupal.blazy;
    var dataAttr = elm.getAttribute('data-blazy');
    var opts = (!dataAttr || dataAttr === '1') ? {} : (_db.parse(dataAttr) || {});

    me.revalidate = me.revalidate || elm.classList.contains('blazy--revalidate');
    elm.classList.add('blazy--on');

    // Initializes native, IntersectionObserver, or Blazy instance.
    // @todo attempts to optimize nested blazies, remove check if any issue.
    if (_db.closest(elm, '.blazy') === null) {
      elm.classList.add(_firstBlazy);
      opts.isUniform = me.contains(elm, 'blazy--field') || me.contains(elm, 'blazy--grid') || me.contains(elm, 'blazy--uniform');
      initBlazy(elm, opts);
    }
  }

  /**
   * Attaches blazy behavior to HTML element identified by .blazy/[data-blazy].
   *
   * The .blazy/[data-blazy] is the .b-lazy container, might be .field, etc.
   * The .b-lazy is the individual IMG, IFRAME, PICTURE, VIDEO, DIV, BODY, etc.
   * The lazy-loaded element is .b-lazy, not its container. Note the hypen (b-)!
   *
   * @type {Drupal~behavior}
   */
  Drupal.behaviors.blazy = {
    attach: function (context) {
      // Drupal.attachBehaviors already does this so if this is necessary,
      // someone does an invalid call. But let's be robust here.
      // Note: context can be unexpected <script> element with Media library.
      context = context || document;

      // Originally identified at D7, yet might happen at D8 with AJAX.
      // Prevents jQuery AJAX messes up where context might be an array.
      if ('length' in context) {
        context = context[0];
      }

      // Runs Blazy with multi-serving images, and aspect ratio supports.
      // W/o [data-blazy] to address various scenarios like custom simple works,
      // or within Views UI which is not easy to set [data-blazy] via UI.
      _db.once(Drupal.blazy.forEach(context));
    }
  };

}(Drupal, drupalSettings, dBlazy, this, this.document));
;
