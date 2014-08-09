/* ===================================================
 * bootstrap-transition.js v2.1.0
 * http://twitter.github.com/bootstrap/javascript.html#transitions
 * ===================================================
 * Copyright 2012 Twitter, Inc.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 * ========================================================== */


!function ($) {

  $(function () {

    "use strict"; // jshint ;_;


    /* CSS TRANSITION SUPPORT (http://www.modernizr.com/)
     * ======================================================= */

    $.support.transition = (function () {

      var transitionEnd = (function () {

        var el = document.createElement('bootstrap')
          , transEndEventNames = {
               'WebkitTransition' : 'webkitTransitionEnd'
            ,  'MozTransition'    : 'transitionend'
            ,  'OTransition'      : 'oTransitionEnd otransitionend'
            ,  'transition'       : 'transitionend'
            }
          , name

        for (name in transEndEventNames){
          if (el.style[name] !== undefined) {
            return transEndEventNames[name]
          }
        }

      }())

      return transitionEnd && {
        end: transitionEnd
      }

    })()

  })

}(window.jQuery);/* ==========================================================
 * bootstrap-alert.js v2.1.0
 * http://twitter.github.com/bootstrap/javascript.html#alerts
 * ==========================================================
 * Copyright 2012 Twitter, Inc.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 * ========================================================== */


!function ($) {

  "use strict"; // jshint ;_;


 /* ALERT CLASS DEFINITION
  * ====================== */

  var dismiss = '[data-dismiss="alert"]'
    , Alert = function (el) {
        $(el).on('click', dismiss, this.close)
      }

  Alert.prototype.close = function (e) {
    var $this = $(this)
      , selector = $this.attr('data-target')
      , $parent

    if (!selector) {
      selector = $this.attr('href')
      selector = selector && selector.replace(/.*(?=#[^\s]*$)/, '') //strip for ie7
    }

    $parent = $(selector)

    e && e.preventDefault()

    $parent.length || ($parent = $this.hasClass('alert') ? $this : $this.parent())

    $parent.trigger(e = $.Event('close'))

    if (e.isDefaultPrevented()) return

    $parent.removeClass('in')

    function removeElement() {
      $parent
        .trigger('closed')
        .remove()
    }

    $.support.transition && $parent.hasClass('fade') ?
      $parent.on($.support.transition.end, removeElement) :
      removeElement()
  }


 /* ALERT PLUGIN DEFINITION
  * ======================= */

  $.fn.alert = function (option) {
    return this.each(function () {
      var $this = $(this)
        , data = $this.data('alert')
      if (!data) $this.data('alert', (data = new Alert(this)))
      if (typeof option == 'string') data[option].call($this)
    })
  }

  $.fn.alert.Constructor = Alert


 /* ALERT DATA-API
  * ============== */

  $(function () {
    $('body').on('click.alert.data-api', dismiss, Alert.prototype.close)
  })

}(window.jQuery);/* ============================================================
 * bootstrap-button.js v2.1.0
 * http://twitter.github.com/bootstrap/javascript.html#buttons
 * ============================================================
 * Copyright 2012 Twitter, Inc.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 * ============================================================ */


!function ($) {

  "use strict"; // jshint ;_;


 /* BUTTON PUBLIC CLASS DEFINITION
  * ============================== */

  var Button = function (element, options) {
    this.$element = $(element)
    this.options = $.extend({}, $.fn.button.defaults, options)
  }

  Button.prototype.setState = function (state) {
    var d = 'disabled'
      , $el = this.$element
      , data = $el.data()
      , val = $el.is('input') ? 'val' : 'html'

    state = state + 'Text'
    data.resetText || $el.data('resetText', $el[val]())

    $el[val](data[state] || this.options[state])

    // push to event loop to allow forms to submit
    setTimeout(function () {
      state == 'loadingText' ?
        $el.addClass(d).attr(d, d) :
        $el.removeClass(d).removeAttr(d)
    }, 0)
  }

  Button.prototype.toggle = function () {
    var $parent = this.$element.parent('[data-toggle="buttons-radio"]')

    $parent && $parent
      .find('.active')
      .removeClass('active')

    this.$element.toggleClass('active')
  }


 /* BUTTON PLUGIN DEFINITION
  * ======================== */

  $.fn.button = function (option) {
    return this.each(function () {
      var $this = $(this)
        , data = $this.data('button')
        , options = typeof option == 'object' && option
      if (!data) $this.data('button', (data = new Button(this, options)))
      if (option == 'toggle') data.toggle()
      else if (option) data.setState(option)
    })
  }

  $.fn.button.defaults = {
    loadingText: 'loading...'
  }

  $.fn.button.Constructor = Button


 /* BUTTON DATA-API
  * =============== */

  $(function () {
    $('body').on('click.button.data-api', '[data-toggle^=button]', function ( e ) {
      var $btn = $(e.target)
      if (!$btn.hasClass('btn')) $btn = $btn.closest('.btn')
      $btn.button('toggle')
    })
  })

}(window.jQuery);/* ==========================================================
 * bootstrap-carousel.js v2.1.0
 * http://twitter.github.com/bootstrap/javascript.html#carousel
 * ==========================================================
 * Copyright 2012 Twitter, Inc.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 * ========================================================== */


!function ($) {

  "use strict"; // jshint ;_;


 /* CAROUSEL CLASS DEFINITION
  * ========================= */

  var Carousel = function (element, options) {
    this.$element = $(element)
    this.options = options
    this.options.slide && this.slide(this.options.slide)
    this.options.pause == 'hover' && this.$element
      .on('mouseenter', $.proxy(this.pause, this))
      .on('mouseleave', $.proxy(this.cycle, this))
  }

  Carousel.prototype = {

    cycle: function (e) {
      if (!e) this.paused = false
      this.options.interval
        && !this.paused
        && (this.interval = setInterval($.proxy(this.next, this), this.options.interval))
      return this
    }

  , to: function (pos) {
      var $active = this.$element.find('.item.active')
        , children = $active.parent().children()
        , activePos = children.index($active)
        , that = this

      if (pos > (children.length - 1) || pos < 0) return

      if (this.sliding) {
        return this.$element.one('slid', function () {
          that.to(pos)
        })
      }

      if (activePos == pos) {
        return this.pause().cycle()
      }

      return this.slide(pos > activePos ? 'next' : 'prev', $(children[pos]))
    }

  , pause: function (e) {
      if (!e) this.paused = true
      if (this.$element.find('.next, .prev').length && $.support.transition.end) {
        this.$element.trigger($.support.transition.end)
        this.cycle()
      }
      clearInterval(this.interval)
      this.interval = null
      return this
    }

  , next: function () {
      if (this.sliding) return
      return this.slide('next')
    }

  , prev: function () {
      if (this.sliding) return
      return this.slide('prev')
    }

  , slide: function (type, next) {
      var $active = this.$element.find('.item.active')
        , $next = next || $active[type]()
        , isCycling = this.interval
        , direction = type == 'next' ? 'left' : 'right'
        , fallback  = type == 'next' ? 'first' : 'last'
        , that = this
        , e = $.Event('slide', {
            relatedTarget: $next[0]
          })

      this.sliding = true

      isCycling && this.pause()

      $next = $next.length ? $next : this.$element.find('.item')[fallback]()

      if ($next.hasClass('active')) return

      if ($.support.transition && this.$element.hasClass('slide')) {
        this.$element.trigger(e)
        if (e.isDefaultPrevented()) return
        $next.addClass(type)
        $next[0].offsetWidth // force reflow
        $active.addClass(direction)
        $next.addClass(direction)
        this.$element.one($.support.transition.end, function () {
          $next.removeClass([type, direction].join(' ')).addClass('active')
          $active.removeClass(['active', direction].join(' '))
          that.sliding = false
          setTimeout(function () { that.$element.trigger('slid') }, 0)
        })
      } else {
        this.$element.trigger(e)
        if (e.isDefaultPrevented()) return
        $active.removeClass('active')
        $next.addClass('active')
        this.sliding = false
        this.$element.trigger('slid')
      }

      isCycling && this.cycle()

      return this
    }

  }


 /* CAROUSEL PLUGIN DEFINITION
  * ========================== */

  $.fn.carousel = function (option) {
    return this.each(function () {
      var $this = $(this)
        , data = $this.data('carousel')
        , options = $.extend({}, $.fn.carousel.defaults, typeof option == 'object' && option)
        , action = typeof option == 'string' ? option : options.slide
      if (!data) $this.data('carousel', (data = new Carousel(this, options)))
      if (typeof option == 'number') data.to(option)
      else if (action) data[action]()
      else if (options.interval) data.cycle()
    })
  }

  $.fn.carousel.defaults = {
    interval: 5000
  , pause: 'hover'
  }

  $.fn.carousel.Constructor = Carousel


 /* CAROUSEL DATA-API
  * ================= */

  $(function () {
    $('body').on('click.carousel.data-api', '[data-slide]', function ( e ) {
      var $this = $(this), href
        , $target = $($this.attr('data-target') || (href = $this.attr('href')) && href.replace(/.*(?=#[^\s]+$)/, '')) //strip for ie7
        , options = !$target.data('modal') && $.extend({}, $target.data(), $this.data())
      $target.carousel(options)
      e.preventDefault()
    })
  })

}(window.jQuery);/* =============================================================
 * bootstrap-collapse.js v2.1.0
 * http://twitter.github.com/bootstrap/javascript.html#collapse
 * =============================================================
 * Copyright 2012 Twitter, Inc.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 * ============================================================ */


!function ($) {

  "use strict"; // jshint ;_;


 /* COLLAPSE PUBLIC CLASS DEFINITION
  * ================================ */

  var Collapse = function (element, options) {
    this.$element = $(element)
    this.options = $.extend({}, $.fn.collapse.defaults, options)

    if (this.options.parent) {
      this.$parent = $(this.options.parent)
    }

    this.options.toggle && this.toggle()
  }

  Collapse.prototype = {

    constructor: Collapse

  , dimension: function () {
      var hasWidth = this.$element.hasClass('width')
      return hasWidth ? 'width' : 'height'
    }

  , show: function () {
      var dimension
        , scroll
        , actives
        , hasData

      if (this.transitioning) return

      dimension = this.dimension()
      scroll = $.camelCase(['scroll', dimension].join('-'))
      actives = this.$parent && this.$parent.find('> .accordion-group > .in')

      if (actives && actives.length) {
        hasData = actives.data('collapse')
        if (hasData && hasData.transitioning) return
        actives.collapse('hide')
        hasData || actives.data('collapse', null)
      }

      this.$element[dimension](0)
      this.transition('addClass', $.Event('show'), 'shown')
      $.support.transition && this.$element[dimension](this.$element[0][scroll])
    }

  , hide: function () {
      var dimension
      if (this.transitioning) return
      dimension = this.dimension()
      this.reset(this.$element[dimension]())
      this.transition('removeClass', $.Event('hide'), 'hidden')
      this.$element[dimension](0)
    }

  , reset: function (size) {
      var dimension = this.dimension()

      this.$element
        .removeClass('collapse')
        [dimension](size || 'auto')
        [0].offsetWidth

      this.$element[size !== null ? 'addClass' : 'removeClass']('collapse')

      return this
    }

  , transition: function (method, startEvent, completeEvent) {
      var that = this
        , complete = function () {
            if (startEvent.type == 'show') that.reset()
            that.transitioning = 0
            that.$element.trigger(completeEvent)
          }

      this.$element.trigger(startEvent)

      if (startEvent.isDefaultPrevented()) return

      this.transitioning = 1

      this.$element[method]('in')

      $.support.transition && this.$element.hasClass('collapse') ?
        this.$element.one($.support.transition.end, complete) :
        complete()
    }

  , toggle: function () {
      this[this.$element.hasClass('in') ? 'hide' : 'show']()
    }

  }


 /* COLLAPSIBLE PLUGIN DEFINITION
  * ============================== */

  $.fn.collapse = function (option) {
    return this.each(function () {
      var $this = $(this)
        , data = $this.data('collapse')
        , options = typeof option == 'object' && option
      if (!data) $this.data('collapse', (data = new Collapse(this, options)))
      if (typeof option == 'string') data[option]()
    })
  }

  $.fn.collapse.defaults = {
    toggle: true
  }

  $.fn.collapse.Constructor = Collapse


 /* COLLAPSIBLE DATA-API
  * ==================== */

  $(function () {
    $('body').on('click.collapse.data-api', '[data-toggle=collapse]', function (e) {
      var $this = $(this), href
        , target = $this.attr('data-target')
          || e.preventDefault()
          || (href = $this.attr('href')) && href.replace(/.*(?=#[^\s]+$)/, '') //strip for ie7
        , option = $(target).data('collapse') ? 'toggle' : $this.data()
      $this[$(target).hasClass('in') ? 'addClass' : 'removeClass']('collapsed')
      $(target).collapse(option)
    })
  })

}(window.jQuery);/* ============================================================
 * bootstrap-dropdown.js v2.1.0
 * http://twitter.github.com/bootstrap/javascript.html#dropdowns
 * ============================================================
 * Copyright 2012 Twitter, Inc.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 * ============================================================ */


!function ($) {

  "use strict"; // jshint ;_;


 /* DROPDOWN CLASS DEFINITION
  * ========================= */

  var toggle = '[data-toggle=dropdown]'
    , Dropdown = function (element) {
        var $el = $(element).on('click.dropdown.data-api', this.toggle)
        $('html').on('click.dropdown.data-api', function () {
          $el.parent().removeClass('open')
        })
      }

  Dropdown.prototype = {

    constructor: Dropdown

  , toggle: function (e) {
      var $this = $(this)
        , $parent
        , isActive

      if ($this.is('.disabled, :disabled')) return

      $parent = getParent($this)

      isActive = $parent.hasClass('open')

      clearMenus()

      if (!isActive) {
        $parent.toggleClass('open')
        $this.focus()
      }

      return false
    }

  , keydown: function (e) {
      var $this
        , $items
        , $active
        , $parent
        , isActive
        , index

      if (!/(38|40|27)/.test(e.keyCode)) return

      $this = $(this)

      e.preventDefault()
      e.stopPropagation()

      if ($this.is('.disabled, :disabled')) return

      $parent = getParent($this)

      isActive = $parent.hasClass('open')

      if (!isActive || (isActive && e.keyCode == 27)) return $this.click()

      $items = $('[role=menu] li:not(.divider) a', $parent)

      if (!$items.length) return

      index = $items.index($items.filter(':focus'))

      if (e.keyCode == 38 && index > 0) index--                                        // up
      if (e.keyCode == 40 && index < $items.length - 1) index++                        // down
      if (!~index) index = 0

      $items
        .eq(index)
        .focus()
    }

  }

  function clearMenus() {
    getParent($(toggle))
      .removeClass('open')
  }

  function getParent($this) {
    var selector = $this.attr('data-target')
      , $parent

    if (!selector) {
      selector = $this.attr('href')
      selector = selector && selector.replace(/.*(?=#[^\s]*$)/, '') //strip for ie7
    }

    $parent = $(selector)
    $parent.length || ($parent = $this.parent())

    return $parent
  }


  /* DROPDOWN PLUGIN DEFINITION
   * ========================== */

  $.fn.dropdown = function (option) {
    return this.each(function () {
      var $this = $(this)
        , data = $this.data('dropdown')
      if (!data) $this.data('dropdown', (data = new Dropdown(this)))
      if (typeof option == 'string') data[option].call($this)
    })
  }

  $.fn.dropdown.Constructor = Dropdown


  /* APPLY TO STANDARD DROPDOWN ELEMENTS
   * =================================== */

  $(function () {
    $('html')
      .on('click.dropdown.data-api touchstart.dropdown.data-api', clearMenus)
    $('body')
      .on('click.dropdown touchstart.dropdown.data-api', '.dropdown', function (e) { e.stopPropagation() })
      .on('click.dropdown.data-api touchstart.dropdown.data-api'  , toggle, Dropdown.prototype.toggle)
      .on('keydown.dropdown.data-api touchstart.dropdown.data-api', toggle + ', [role=menu]' , Dropdown.prototype.keydown)
  })

}(window.jQuery);/* =========================================================
 * bootstrap-modal.js v2.1.0
 * http://twitter.github.com/bootstrap/javascript.html#modals
 * =========================================================
 * Copyright 2012 Twitter, Inc.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 * ========================================================= */


!function ($) {

  "use strict"; // jshint ;_;


 /* MODAL CLASS DEFINITION
  * ====================== */

  var Modal = function (element, options) {
    this.options = options
    this.$element = $(element)
      .delegate('[data-dismiss="modal"]', 'click.dismiss.modal', $.proxy(this.hide, this))
    this.options.remote && this.$element.find('.modal-body').load(this.options.remote)
  }

  Modal.prototype = {

      constructor: Modal

    , toggle: function () {
        return this[!this.isShown ? 'show' : 'hide']()
      }

    , show: function () {
        var that = this
          , e = $.Event('show')

        this.$element.trigger(e)

        if (this.isShown || e.isDefaultPrevented()) return

        $('body').addClass('modal-open')

        this.isShown = true

        this.escape()

        this.backdrop(function () {
          var transition = $.support.transition && that.$element.hasClass('fade')

          if (!that.$element.parent().length) {
            that.$element.appendTo(document.body) //don't move modals dom position
          }

          that.$element
            .show()

          if (transition) {
            that.$element[0].offsetWidth // force reflow
          }

          that.$element
            .addClass('in')
            .attr('aria-hidden', false)
            .focus()

          that.enforceFocus()

          transition ?
            that.$element.one($.support.transition.end, function () { that.$element.trigger('shown') }) :
            that.$element.trigger('shown')

        })
      }

    , hide: function (e) {
        e && e.preventDefault()

        var that = this

        e = $.Event('hide')

        this.$element.trigger(e)

        if (!this.isShown || e.isDefaultPrevented()) return

        this.isShown = false

        $('body').removeClass('modal-open')

        this.escape()

        $(document).off('focusin.modal')

        this.$element
          .removeClass('in')
          .attr('aria-hidden', true)

        $.support.transition && this.$element.hasClass('fade') ?
          this.hideWithTransition() :
          this.hideModal()
      }

    , enforceFocus: function () {
        var that = this
        $(document).on('focusin.modal', function (e) {
          if (that.$element[0] !== e.target && !that.$element.has(e.target).length) {
            that.$element.focus()
          }
        })
      }

    , escape: function () {
        var that = this
        if (this.isShown && this.options.keyboard) {
          this.$element.on('keyup.dismiss.modal', function ( e ) {
            e.which == 27 && that.hide()
          })
        } else if (!this.isShown) {
          this.$element.off('keyup.dismiss.modal')
        }
      }

    , hideWithTransition: function () {
        var that = this
          , timeout = setTimeout(function () {
              that.$element.off($.support.transition.end)
              that.hideModal()
            }, 500)

        this.$element.one($.support.transition.end, function () {
          clearTimeout(timeout)
          that.hideModal()
        })
      }

    , hideModal: function (that) {
        this.$element
          .hide()
          .trigger('hidden')

        this.backdrop()
      }

    , removeBackdrop: function () {
        this.$backdrop.remove()
        this.$backdrop = null
      }

    , backdrop: function (callback) {
        var that = this
          , animate = this.$element.hasClass('fade') ? 'fade' : ''

        if (this.isShown && this.options.backdrop) {
          var doAnimate = $.support.transition && animate

          this.$backdrop = $('<div class="modal-backdrop ' + animate + '" />')
            .appendTo(document.body)

          if (this.options.backdrop != 'static') {
            this.$backdrop.click($.proxy(this.hide, this))
          }

          if (doAnimate) this.$backdrop[0].offsetWidth // force reflow

          this.$backdrop.addClass('in')

          doAnimate ?
            this.$backdrop.one($.support.transition.end, callback) :
            callback()

        } else if (!this.isShown && this.$backdrop) {
          this.$backdrop.removeClass('in')

          $.support.transition && this.$element.hasClass('fade')?
            this.$backdrop.one($.support.transition.end, $.proxy(this.removeBackdrop, this)) :
            this.removeBackdrop()

        } else if (callback) {
          callback()
        }
      }
  }


 /* MODAL PLUGIN DEFINITION
  * ======================= */

  $.fn.modal = function (option) {
    return this.each(function () {
      var $this = $(this)
        , data = $this.data('modal')
        , options = $.extend({}, $.fn.modal.defaults, $this.data(), typeof option == 'object' && option)
      if (!data) $this.data('modal', (data = new Modal(this, options)))
      if (typeof option == 'string') data[option]()
      else if (options.show) data.show()
    })
  }

  $.fn.modal.defaults = {
      backdrop: true
    , keyboard: true
    , show: true
  }

  $.fn.modal.Constructor = Modal


 /* MODAL DATA-API
  * ============== */

  $(function () {
    $('body').on('click.modal.data-api', '[data-toggle="modal"]', function ( e ) {
      var $this = $(this)
        , href = $this.attr('href')
        , $target = $($this.attr('data-target') || (href && href.replace(/.*(?=#[^\s]+$)/, ''))) //strip for ie7
        , option = $target.data('modal') ? 'toggle' : $.extend({ remote: !/#/.test(href) && href }, $target.data(), $this.data())

      e.preventDefault()

      $target
        .modal(option)
        .one('hide', function () {
          $this.focus()
        })
    })
  })

}(window.jQuery);/* ===========================================================
 * bootstrap-tooltip.js v2.1.0
 * http://twitter.github.com/bootstrap/javascript.html#tooltips
 * Inspired by the original jQuery.tipsy by Jason Frame
 * ===========================================================
 * Copyright 2012 Twitter, Inc.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 * ========================================================== */


!function ($) {

  "use strict"; // jshint ;_;


 /* TOOLTIP PUBLIC CLASS DEFINITION
  * =============================== */

  var Tooltip = function (element, options) {
    this.init('tooltip', element, options)
  }

  Tooltip.prototype = {

    constructor: Tooltip

  , init: function (type, element, options) {
      var eventIn
        , eventOut

      this.type = type
      this.$element = $(element)
      this.options = this.getOptions(options)
      this.enabled = true

      if (this.options.trigger == 'click') {
        this.$element.on('click.' + this.type, this.options.selector, $.proxy(this.toggle, this))
      } else if (this.options.trigger != 'manual') {
        eventIn = this.options.trigger == 'hover' ? 'mouseenter' : 'focus'
        eventOut = this.options.trigger == 'hover' ? 'mouseleave' : 'blur'
        this.$element.on(eventIn + '.' + this.type, this.options.selector, $.proxy(this.enter, this))
        this.$element.on(eventOut + '.' + this.type, this.options.selector, $.proxy(this.leave, this))
      }

      this.options.selector ?
        (this._options = $.extend({}, this.options, { trigger: 'manual', selector: '' })) :
        this.fixTitle()
    }

  , getOptions: function (options) {
      options = $.extend({}, $.fn[this.type].defaults, options, this.$element.data())

      if (options.delay && typeof options.delay == 'number') {
        options.delay = {
          show: options.delay
        , hide: options.delay
        }
      }

      return options
    }

  , enter: function (e) {
      var self = $(e.currentTarget)[this.type](this._options).data(this.type)

      if (!self.options.delay || !self.options.delay.show) return self.show()

      clearTimeout(this.timeout)
      self.hoverState = 'in'
      this.timeout = setTimeout(function() {
        if (self.hoverState == 'in') self.show()
      }, self.options.delay.show)
    }

  , leave: function (e) {
      var self = $(e.currentTarget)[this.type](this._options).data(this.type)

      if (this.timeout) clearTimeout(this.timeout)
      if (!self.options.delay || !self.options.delay.hide) return self.hide()

      self.hoverState = 'out'
      this.timeout = setTimeout(function() {
        if (self.hoverState == 'out') self.hide()
      }, self.options.delay.hide)
    }

  , show: function () {
      var $tip
        , inside
        , pos
        , actualWidth
        , actualHeight
        , placement
        , tp

      if (this.hasContent() && this.enabled) {
        $tip = this.tip()
        this.setContent()

        if (this.options.animation) {
          $tip.addClass('fade')
        }

        placement = typeof this.options.placement == 'function' ?
          this.options.placement.call(this, $tip[0], this.$element[0]) :
          this.options.placement

        inside = /in/.test(placement)

        $tip
          .remove()
          .css({ top: 0, left: 0, display: 'block' })
          .appendTo(inside ? this.$element : document.body)

        pos = this.getPosition(inside)

        actualWidth = $tip[0].offsetWidth
        actualHeight = $tip[0].offsetHeight

        switch (inside ? placement.split(' ')[1] : placement) {
          case 'bottom':
            tp = {top: pos.top + pos.height, left: pos.left + pos.width / 2 - actualWidth / 2}
            break
          case 'top':
            tp = {top: pos.top - actualHeight, left: pos.left + pos.width / 2 - actualWidth / 2}
            break
          case 'left':
            tp = {top: pos.top + pos.height / 2 - actualHeight / 2, left: pos.left - actualWidth}
            break
          case 'right':
            tp = {top: pos.top + pos.height / 2 - actualHeight / 2, left: pos.left + pos.width}
            break
        }

        $tip
          .css(tp)
          .addClass(placement)
          .addClass('in')
      }
    }

  , setContent: function () {
      var $tip = this.tip()
        , title = this.getTitle()

      $tip.find('.tooltip-inner')[this.options.html ? 'html' : 'text'](title)
      $tip.removeClass('fade in top bottom left right')
    }

  , hide: function () {
      var that = this
        , $tip = this.tip()

      $tip.removeClass('in')

      function removeWithAnimation() {
        var timeout = setTimeout(function () {
          $tip.off($.support.transition.end).remove()
        }, 500)

        $tip.one($.support.transition.end, function () {
          clearTimeout(timeout)
          $tip.remove()
        })
      }

      $.support.transition && this.$tip.hasClass('fade') ?
        removeWithAnimation() :
        $tip.remove()

      return this
    }

  , fixTitle: function () {
      var $e = this.$element
      if ($e.attr('title') || typeof($e.attr('data-original-title')) != 'string') {
        $e.attr('data-original-title', $e.attr('title') || '').removeAttr('title')
      }
    }

  , hasContent: function () {
      return this.getTitle()
    }

  , getPosition: function (inside) {
      return $.extend({}, (inside ? {top: 0, left: 0} : this.$element.offset()), {
        width: this.$element[0].offsetWidth
      , height: this.$element[0].offsetHeight
      })
    }

  , getTitle: function () {
      var title
        , $e = this.$element
        , o = this.options

      title = $e.attr('data-original-title')
        || (typeof o.title == 'function' ? o.title.call($e[0]) :  o.title)

      return title
    }

  , tip: function () {
      return this.$tip = this.$tip || $(this.options.template)
    }

  , validate: function () {
      if (!this.$element[0].parentNode) {
        this.hide()
        this.$element = null
        this.options = null
      }
    }

  , enable: function () {
      this.enabled = true
    }

  , disable: function () {
      this.enabled = false
    }

  , toggleEnabled: function () {
      this.enabled = !this.enabled
    }

  , toggle: function () {
      this[this.tip().hasClass('in') ? 'hide' : 'show']()
    }

  , destroy: function () {
      this.hide().$element.off('.' + this.type).removeData(this.type)
    }

  }


 /* TOOLTIP PLUGIN DEFINITION
  * ========================= */

  $.fn.tooltip = function ( option ) {
    return this.each(function () {
      var $this = $(this)
        , data = $this.data('tooltip')
        , options = typeof option == 'object' && option
      if (!data) $this.data('tooltip', (data = new Tooltip(this, options)))
      if (typeof option == 'string') data[option]()
    })
  }

  $.fn.tooltip.Constructor = Tooltip

  $.fn.tooltip.defaults = {
    animation: true
  , placement: 'top'
  , selector: false
  , template: '<div class="tooltip"><div class="tooltip-arrow"></div><div class="tooltip-inner"></div></div>'
  , trigger: 'hover'
  , title: ''
  , delay: 0
  , html: true
  }

}(window.jQuery);
/* ===========================================================
 * bootstrap-popover.js v2.1.0
 * http://twitter.github.com/bootstrap/javascript.html#popovers
 * ===========================================================
 * Copyright 2012 Twitter, Inc.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 * =========================================================== */


!function ($) {

  "use strict"; // jshint ;_;


 /* POPOVER PUBLIC CLASS DEFINITION
  * =============================== */

  var Popover = function (element, options) {
    this.init('popover', element, options)
  }


  /* NOTE: POPOVER EXTENDS BOOTSTRAP-TOOLTIP.js
     ========================================== */

  Popover.prototype = $.extend({}, $.fn.tooltip.Constructor.prototype, {

    constructor: Popover

  , setContent: function () {
      var $tip = this.tip()
        , title = this.getTitle()
        , content = this.getContent()

      $tip.find('.popover-title')[this.options.html ? 'html' : 'text'](title)
      $tip.find('.popover-content > *')[this.options.html ? 'html' : 'text'](content)

      $tip.removeClass('fade top bottom left right in')
    }

  , hasContent: function () {
      return this.getTitle() || this.getContent()
    }

  , getContent: function () {
      var content
        , $e = this.$element
        , o = this.options

      content = $e.attr('data-content')
        || (typeof o.content == 'function' ? o.content.call($e[0]) :  o.content)

      return content
    }

  , tip: function () {
      if (!this.$tip) {
        this.$tip = $(this.options.template)
      }
      return this.$tip
    }

  , destroy: function () {
      this.hide().$element.off('.' + this.type).removeData(this.type)
    }

  })


 /* POPOVER PLUGIN DEFINITION
  * ======================= */

  $.fn.popover = function (option) {
    return this.each(function () {
      var $this = $(this)
        , data = $this.data('popover')
        , options = typeof option == 'object' && option
      if (!data) $this.data('popover', (data = new Popover(this, options)))
      if (typeof option == 'string') data[option]()
    })
  }

  $.fn.popover.Constructor = Popover

  $.fn.popover.defaults = $.extend({} , $.fn.tooltip.defaults, {
    placement: 'right'
  , trigger: 'click'
  , content: ''
  , template: '<div class="popover"><div class="arrow"></div><div class="popover-inner"><h3 class="popover-title"></h3><div class="popover-content"><p></p></div></div></div>'
  })

}(window.jQuery);/* =============================================================
 * bootstrap-scrollspy.js v2.1.0
 * http://twitter.github.com/bootstrap/javascript.html#scrollspy
 * =============================================================
 * Copyright 2012 Twitter, Inc.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 * ============================================================== */


!function ($) {

  "use strict"; // jshint ;_;


 /* SCROLLSPY CLASS DEFINITION
  * ========================== */

  function ScrollSpy(element, options) {
    var process = $.proxy(this.process, this)
      , $element = $(element).is('body') ? $(window) : $(element)
      , href
    this.options = $.extend({}, $.fn.scrollspy.defaults, options)
    this.$scrollElement = $element.on('scroll.scroll-spy.data-api', process)
    this.selector = (this.options.target
      || ((href = $(element).attr('href')) && href.replace(/.*(?=#[^\s]+$)/, '')) //strip for ie7
      || '') + ' .nav li > a'
    this.$body = $('body')
    this.refresh()
    this.process()
  }

  ScrollSpy.prototype = {

      constructor: ScrollSpy

    , refresh: function () {
        var self = this
          , $targets

        this.offsets = $([])
        this.targets = $([])

        $targets = this.$body
          .find(this.selector)
          .map(function () {
            var $el = $(this)
              , href = $el.data('target') || $el.attr('href')
              , $href = /^#\w/.test(href) && $(href)
            return ( $href
              && $href.length
              && [[ $href.position().top, href ]] ) || null
          })
          .sort(function (a, b) { return a[0] - b[0] })
          .each(function () {
            self.offsets.push(this[0])
            self.targets.push(this[1])
          })
      }

    , process: function () {
        var scrollTop = this.$scrollElement.scrollTop() + this.options.offset
          , scrollHeight = this.$scrollElement[0].scrollHeight || this.$body[0].scrollHeight
          , maxScroll = scrollHeight - this.$scrollElement.height()
          , offsets = this.offsets
          , targets = this.targets
          , activeTarget = this.activeTarget
          , i

        if (scrollTop >= maxScroll) {
          return activeTarget != (i = targets.last()[0])
            && this.activate ( i )
        }

        for (i = offsets.length; i--;) {
          activeTarget != targets[i]
            && scrollTop >= offsets[i]
            && (!offsets[i + 1] || scrollTop <= offsets[i + 1])
            && this.activate( targets[i] )
        }
      }

    , activate: function (target) {
        var active
          , selector

        this.activeTarget = target

        $(this.selector)
          .parent('.active')
          .removeClass('active')

        selector = this.selector
          + '[data-target="' + target + '"],'
          + this.selector + '[href="' + target + '"]'

        active = $(selector)
          .parent('li')
          .addClass('active')

        if (active.parent('.dropdown-menu').length)  {
          active = active.closest('li.dropdown').addClass('active')
        }

        active.trigger('activate')
      }

  }


 /* SCROLLSPY PLUGIN DEFINITION
  * =========================== */

  $.fn.scrollspy = function (option) {
    return this.each(function () {
      var $this = $(this)
        , data = $this.data('scrollspy')
        , options = typeof option == 'object' && option
      if (!data) $this.data('scrollspy', (data = new ScrollSpy(this, options)))
      if (typeof option == 'string') data[option]()
    })
  }

  $.fn.scrollspy.Constructor = ScrollSpy

  $.fn.scrollspy.defaults = {
    offset: 10
  }


 /* SCROLLSPY DATA-API
  * ================== */

  $(window).on('load', function () {
    $('[data-spy="scroll"]').each(function () {
      var $spy = $(this)
      $spy.scrollspy($spy.data())
    })
  })

}(window.jQuery);/* ========================================================
 * bootstrap-tab.js v2.1.0
 * http://twitter.github.com/bootstrap/javascript.html#tabs
 * ========================================================
 * Copyright 2012 Twitter, Inc.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 * ======================================================== */


!function ($) {

  "use strict"; // jshint ;_;


 /* TAB CLASS DEFINITION
  * ==================== */

  var Tab = function (element) {
    this.element = $(element)
  }

  Tab.prototype = {

    constructor: Tab

  , show: function () {
      var $this = this.element
        , $ul = $this.closest('ul:not(.dropdown-menu)')
        , selector = $this.attr('data-target')
        , previous
        , $target
        , e

      if (!selector) {
        selector = $this.attr('href')
        selector = selector && selector.replace(/.*(?=#[^\s]*$)/, '') //strip for ie7
      }

      if ( $this.parent('li').hasClass('active') ) return

      previous = $ul.find('.active a').last()[0]

      e = $.Event('show', {
        relatedTarget: previous
      })

      $this.trigger(e)

      if (e.isDefaultPrevented()) return

      $target = $(selector)

      this.activate($this.parent('li'), $ul)
      this.activate($target, $target.parent(), function () {
        $this.trigger({
          type: 'shown'
        , relatedTarget: previous
        })
      })
    }

  , activate: function ( element, container, callback) {
      var $active = container.find('> .active')
        , transition = callback
            && $.support.transition
            && $active.hasClass('fade')

      function next() {
        $active
          .removeClass('active')
          .find('> .dropdown-menu > .active')
          .removeClass('active')

        element.addClass('active')

        if (transition) {
          element[0].offsetWidth // reflow for transition
          element.addClass('in')
        } else {
          element.removeClass('fade')
        }

        if ( element.parent('.dropdown-menu') ) {
          element.closest('li.dropdown').addClass('active')
        }

        callback && callback()
      }

      transition ?
        $active.one($.support.transition.end, next) :
        next()

      $active.removeClass('in')
    }
  }


 /* TAB PLUGIN DEFINITION
  * ===================== */

  $.fn.tab = function ( option ) {
    return this.each(function () {
      var $this = $(this)
        , data = $this.data('tab')
      if (!data) $this.data('tab', (data = new Tab(this)))
      if (typeof option == 'string') data[option]()
    })
  }

  $.fn.tab.Constructor = Tab


 /* TAB DATA-API
  * ============ */

  $(function () {
    $('body').on('click.tab.data-api', '[data-toggle="tab"], [data-toggle="pill"]', function (e) {
      e.preventDefault()
      $(this).tab('show')
    })
  })

}(window.jQuery);/* =============================================================
 * bootstrap-typeahead.js v2.1.0
 * http://twitter.github.com/bootstrap/javascript.html#typeahead
 * =============================================================
 * Copyright 2012 Twitter, Inc.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 * ============================================================ */


!function($){

  "use strict"; // jshint ;_;


 /* TYPEAHEAD PUBLIC CLASS DEFINITION
  * ================================= */

  var Typeahead = function (element, options) {
    this.$element = $(element)
    this.options = $.extend({}, $.fn.typeahead.defaults, options)
    this.matcher = this.options.matcher || this.matcher
    this.sorter = this.options.sorter || this.sorter
    this.highlighter = this.options.highlighter || this.highlighter
    this.updater = this.options.updater || this.updater
    this.$menu = $(this.options.menu).appendTo('body')
    this.source = this.options.source
    this.shown = false
    this.listen()
  }

  Typeahead.prototype = {

    constructor: Typeahead

  , select: function () {
      var val = this.$menu.find('.active').attr('data-value')
      this.$element
        .val(this.updater(val))
        .change()
      return this.hide()
    }

  , updater: function (item) {
      return item
    }

  , show: function () {
      var pos = $.extend({}, this.$element.offset(), {
        height: this.$element[0].offsetHeight
      })

      this.$menu.css({
        top: pos.top + pos.height
      , left: pos.left
      })

      this.$menu.show()
      this.shown = true
      return this
    }

  , hide: function () {
      this.$menu.hide()
      this.shown = false
      return this
    }

  , lookup: function (event) {
      var items

      this.query = this.$element.val()

      if (!this.query || this.query.length < this.options.minLength) {
        return this.shown ? this.hide() : this
      }

      items = $.isFunction(this.source) ? this.source(this.query, $.proxy(this.process, this)) : this.source

      return items ? this.process(items) : this
    }

  , process: function (items) {
      var that = this

      items = $.grep(items, function (item) {
        return that.matcher(item)
      })

      items = this.sorter(items)

      if (!items.length) {
        return this.shown ? this.hide() : this
      }

      return this.render(items.slice(0, this.options.items)).show()
    }

  , matcher: function (item) {
      return ~item.toLowerCase().indexOf(this.query.toLowerCase())
    }

  , sorter: function (items) {
      var beginswith = []
        , caseSensitive = []
        , caseInsensitive = []
        , item

      while (item = items.shift()) {
        if (!item.toLowerCase().indexOf(this.query.toLowerCase())) beginswith.push(item)
        else if (~item.indexOf(this.query)) caseSensitive.push(item)
        else caseInsensitive.push(item)
      }

      return beginswith.concat(caseSensitive, caseInsensitive)
    }

  , highlighter: function (item) {
      var query = this.query.replace(/[\-\[\]{}()*+?.,\\\^$|#\s]/g, '\\$&')
      return item.replace(new RegExp('(' + query + ')', 'ig'), function ($1, match) {
        return '<strong>' + match + '</strong>'
      })
    }

  , render: function (items) {
      var that = this

      items = $(items).map(function (i, item) {
        i = $(that.options.item).attr('data-value', item)
        i.find('a').html(that.highlighter(item))
        return i[0]
      })

      items.first().addClass('active')
      this.$menu.html(items)
      return this
    }

  , next: function (event) {
      var active = this.$menu.find('.active').removeClass('active')
        , next = active.next()

      if (!next.length) {
        next = $(this.$menu.find('li')[0])
      }

      next.addClass('active')
    }

  , prev: function (event) {
      var active = this.$menu.find('.active').removeClass('active')
        , prev = active.prev()

      if (!prev.length) {
        prev = this.$menu.find('li').last()
      }

      prev.addClass('active')
    }

  , listen: function () {
      this.$element
        .on('blur',     $.proxy(this.blur, this))
        .on('keypress', $.proxy(this.keypress, this))
        .on('keyup',    $.proxy(this.keyup, this))

      if ($.browser.webkit || $.browser.msie) {
        this.$element.on('keydown', $.proxy(this.keydown, this))
      }

      this.$menu
        .on('click', $.proxy(this.click, this))
        .on('mouseenter', 'li', $.proxy(this.mouseenter, this))
    }

  , move: function (e) {
      if (!this.shown) return

      switch(e.keyCode) {
        case 9: // tab
        case 13: // enter
        case 27: // escape
          e.preventDefault()
          break

        case 38: // up arrow
          e.preventDefault()
          this.prev()
          break

        case 40: // down arrow
          e.preventDefault()
          this.next()
          break
      }

      e.stopPropagation()
    }

  , keydown: function (e) {
      this.suppressKeyPressRepeat = !~$.inArray(e.keyCode, [40,38,9,13,27])
      this.move(e)
    }

  , keypress: function (e) {
      if (this.suppressKeyPressRepeat) return
      this.move(e)
    }

  , keyup: function (e) {
      switch(e.keyCode) {
        case 40: // down arrow
        case 38: // up arrow
          break

        case 9: // tab
        case 13: // enter
          if (!this.shown) return
          this.select()
          break

        case 27: // escape
          if (!this.shown) return
          this.hide()
          break

        default:
          this.lookup()
      }

      e.stopPropagation()
      e.preventDefault()
  }

  , blur: function (e) {
      var that = this
      setTimeout(function () { that.hide() }, 150)
    }

  , click: function (e) {
      e.stopPropagation()
      e.preventDefault()
      this.select()
    }

  , mouseenter: function (e) {
      this.$menu.find('.active').removeClass('active')
      $(e.currentTarget).addClass('active')
    }

  }


  /* TYPEAHEAD PLUGIN DEFINITION
   * =========================== */

  $.fn.typeahead = function (option) {
    return this.each(function () {
      var $this = $(this)
        , data = $this.data('typeahead')
        , options = typeof option == 'object' && option
      if (!data) $this.data('typeahead', (data = new Typeahead(this, options)))
      if (typeof option == 'string') data[option]()
    })
  }

  $.fn.typeahead.defaults = {
    source: []
  , items: 8
  , menu: '<ul class="typeahead dropdown-menu"></ul>'
  , item: '<li><a href="#"></a></li>'
  , minLength: 1
  }

  $.fn.typeahead.Constructor = Typeahead


 /*   TYPEAHEAD DATA-API
  * ================== */

  $(function () {
    $('body').on('focus.typeahead.data-api', '[data-provide="typeahead"]', function (e) {
      var $this = $(this)
      if ($this.data('typeahead')) return
      e.preventDefault()
      $this.typeahead($this.data())
    })
  })

}(window.jQuery);
/* ==========================================================
 * bootstrap-affix.js v2.1.0
 * http://twitter.github.com/bootstrap/javascript.html#affix
 * ==========================================================
 * Copyright 2012 Twitter, Inc.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 * ========================================================== */


!function ($) {

  "use strict"; // jshint ;_;


 /* AFFIX CLASS DEFINITION
  * ====================== */

  var Affix = function (element, options) {
    this.options = $.extend({}, $.fn.affix.defaults, options)
    this.$window = $(window).on('scroll.affix.data-api', $.proxy(this.checkPosition, this))
    this.$element = $(element)
    this.checkPosition()
  }

  Affix.prototype.checkPosition = function () {
    if (!this.$element.is(':visible')) return

    var scrollHeight = $(document).height()
      , scrollTop = this.$window.scrollTop()
      , position = this.$element.offset()
      , offset = this.options.offset
      , offsetBottom = offset.bottom
      , offsetTop = offset.top
      , reset = 'affix affix-top affix-bottom'
      , affix

    if (typeof offset != 'object') offsetBottom = offsetTop = offset
    if (typeof offsetTop == 'function') offsetTop = offset.top()
    if (typeof offsetBottom == 'function') offsetBottom = offset.bottom()

    affix = this.unpin != null && (scrollTop + this.unpin <= position.top) ?
      false    : offsetBottom != null && (position.top + this.$element.height() >= scrollHeight - offsetBottom) ?
      'bottom' : offsetTop != null && scrollTop <= offsetTop ?
      'top'    : false

    if (this.affixed === affix) return

    this.affixed = affix
    this.unpin = affix == 'bottom' ? position.top - scrollTop : null

    this.$element.removeClass(reset).addClass('affix' + (affix ? '-' + affix : ''))
  }


 /* AFFIX PLUGIN DEFINITION
  * ======================= */

  $.fn.affix = function (option) {
    return this.each(function () {
      var $this = $(this)
        , data = $this.data('affix')
        , options = typeof option == 'object' && option
      if (!data) $this.data('affix', (data = new Affix(this, options)))
      if (typeof option == 'string') data[option]()
    })
  }

  $.fn.affix.Constructor = Affix

  $.fn.affix.defaults = {
    offset: 0
  }


 /* AFFIX DATA-API
  * ============== */

  $(window).on('load', function () {
    $('[data-spy="affix"]').each(function () {
      var $spy = $(this)
        , data = $spy.data()

      data.offset = data.offset || {}

      data.offsetBottom && (data.offset.bottom = data.offsetBottom)
      data.offsetTop && (data.offset.top = data.offsetTop)

      $spy.affix(data)
    })
  })


}(window.jQuery);




/* =========================================================
 * bootstrap-colorpicker.js 
 * http://www.eyecon.ro/bootstrap-colorpicker
 * =========================================================
 * Copyright 2012 Stefan Petre
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 * ========================================================= */
 
!function( $ ) {
	
	// Color object
	
	var Color = function(val) {
		this.value = {
			h: 1,
			s: 1,
			b: 1,
			a: 1
		};
		this.setColor(val);
	};
	
	Color.prototype = {
		constructor: Color,
		
		//parse a string to HSB
		setColor: function(val){
			val = val.toLowerCase();
			var that = this;
			$.each( CPGlobal.stringParsers, function( i, parser ) {
				var match = parser.re.exec( val ),
					values = match && parser.parse( match ),
					space = parser.space||'rgba';
				if ( values ) {
					if (space == 'hsla') {
						that.value = CPGlobal.RGBtoHSB.apply(null, CPGlobal.HSLtoRGB.apply(null, values));
					} else {
						that.value = CPGlobal.RGBtoHSB.apply(null, values);
					}
					return false;
				}
			});
		},
		
		setHue: function(h) {
			this.value.h = 1- h;
		},
		
		setSaturation: function(s) {
			this.value.s = s;
		},
		
		setLightness: function(b) {
			this.value.b = 1- b;
		},
		
		setAlpha: function(a) {
			this.value.a = parseInt((1 - a)*100, 10)/100;
		},
		
		// HSBtoRGB from RaphaelJS
		// https://github.com/DmitryBaranovskiy/raphael/
		toRGB: function(h, s, b, a) {
			if (!h) {
				h = this.value.h;
				s = this.value.s;
				b = this.value.b;
			}
			h *= 360;
			var R, G, B, X, C;
			h = (h % 360) / 60;
			C = b * s;
			X = C * (1 - Math.abs(h % 2 - 1));
			R = G = B = b - C;

			h = ~~h;
			R += [C, X, 0, 0, X, C][h];
			G += [X, C, C, X, 0, 0][h];
			B += [0, 0, X, C, C, X][h];
			return {
				r: Math.round(R*255),
				g: Math.round(G*255),
				b: Math.round(B*255),
				a: a||this.value.a
			};
		},
		
		toHex: function(h, s, b, a){
			var rgb = this.toRGB(h, s, b, a);
			return '#'+((1 << 24) | (parseInt(rgb.r) << 16) | (parseInt(rgb.g) << 8) | parseInt(rgb.b)).toString(16).substr(1);
		},
		
		toHSL: function(h, s, b, a){
			if (!h) {
				h = this.value.h;
				s = this.value.s;
				b = this.value.b;
			}
			var H = h,
				L = (2 - s) * b,
				S = s * b;
			if (L > 0 && L <= 1) {
				S /= L;
			} else {
				S /= 2 - L;
			}
			L /= 2;
			if (S > 1) {
				S = 1;
			}
			return {
				h: H,
				s: S,
				l: L,
				a: a||this.value.a
			};
		}
	};
	
	// Picker object
	
	var Colorpicker = function(element, options){
		this.element = $(element);
		var format = options.format||this.element.data('color-format')||'hex';
		this.format = CPGlobal.translateFormats[format];
		this.isInput = this.element.is('input');
		this.component = this.element.is('.color') ? this.element.find('.add-on') : false;
		
		this.picker = $(CPGlobal.template)
							.appendTo('body')
							.on('mousedown', $.proxy(this.mousedown, this));
		
		if (this.isInput) {
			this.element.on({
				'focus': $.proxy(this.show, this),
				'keyup': $.proxy(this.update, this)
			});
		} else if (this.component){
			this.component.on({
				'click': $.proxy(this.show, this)
			});
		} else {
			this.element.on({
				'click': $.proxy(this.show, this)
			});
		}
		if (format == 'rgba' || format == 'hsla') {
			this.picker.addClass('alpha');
			this.alpha = this.picker.find('.colorpicker-alpha')[0].style;
		}
		
		if (this.component){
			this.picker.find('.colorpicker-color').hide();
			this.preview = this.element.find('i')[0].style;
		} else {
			this.preview = this.picker.find('div:last')[0].style;
		}
		
		this.base = this.picker.find('div:first')[0].style;
		this.update();
	};
	
	Colorpicker.prototype = {
		constructor: Colorpicker,
		
		show: function(e) {
			this.picker.show();
			this.height = this.component ? this.component.outerHeight() : this.element.outerHeight();
			this.place();
			$(window).on('resize', $.proxy(this.place, this));
			if (!this.isInput) {
				if (e) {
					e.stopPropagation();
					e.preventDefault();
				}
			}
			$(document).on({
				'mousedown': $.proxy(this.hide, this)
			});
			this.element.trigger({
				type: 'show',
				color: this.color
			});
		},
		
		update: function(){
			this.color = new Color(this.isInput ? this.element.prop('value') : this.element.data('color'));
			this.picker.find('i')
				.eq(0).css({left: this.color.value.s*100, top: 100 - this.color.value.b*100}).end()
				.eq(1).css('top', 100 * (1 - this.color.value.h)).end()
				.eq(2).css('top', 100 * (1 - this.color.value.a));
			this.previewColor();
		},
		
		hide: function(){
			this.picker.hide();
			$(window).off('resize', this.place);
			if (!this.isInput) {
				$(document).off({
					'mousedown': this.hide
				});
				if (this.component){
					this.element.find('input').prop('value', this.format.call(this));
				}
				this.element.data('color', this.format.call(this));
			} else {
				this.element.prop('value', this.format.call(this));
			}
			this.element.trigger({
				type: 'hide',
				color: this.color
			});
		},
		
		place: function(){
			var offset = this.component ? this.component.offset() : this.element.offset();
			this.picker.css({
				top: offset.top + this.height,
				left: offset.left
			});
		},
		
		//preview color change
		previewColor: function(){
			this.preview.backgroundColor = this.format.call(this);
			//set the color for brightness/saturation slider
			this.base.backgroundColor = this.color.toHex(this.color.value.h, 1, 1, 1);
			//set te color for alpha slider
			if (this.alpha) {
				this.alpha.backgroundColor = this.color.toHex();
			}
		},
		
		pointer: null,
		
		slider: null,
		
		mousedown: function(e){
			e.stopPropagation();
			e.preventDefault();
			
			var target = $(e.target);
			
			//detect the slider and set the limits and callbacks
			var zone = target.closest('div');
			if (!zone.is('.colorpicker')) {
				if (zone.is('.colorpicker-saturation')) {
					this.slider = $.extend({}, CPGlobal.sliders['saturation']);
				} 
				else if (zone.is('.colorpicker-hue')) {
					this.slider = $.extend({}, CPGlobal.sliders['hue']);
				}
				else if (zone.is('.colorpicker-alpha')) {
					this.slider = $.extend({}, CPGlobal.sliders['alpha']);
				}
				var offset = zone.offset();
				//reference to knob's style
				this.slider.knob = zone.find('i')[0].style;
				this.slider.left = e.pageX - offset.left;
				this.slider.top = e.pageY - offset.top;
				this.pointer = {
					left: e.pageX,
					top: e.pageY
				};
				//trigger mousemove to move the knob to the current position
				$(document).on({
					mousemove: $.proxy(this.mousemove, this),
					mouseup: $.proxy(this.mouseup, this)
				}).trigger('mousemove');
			}
			return false;
		},
		
		mousemove: function(e){
			e.stopPropagation();
			e.preventDefault();
			var left = Math.max(
				0,
				Math.min(
					this.slider.maxLeft,
					this.slider.left + ((e.pageX||this.pointer.left) - this.pointer.left)
				)
			);
			var top = Math.max(
				0,
				Math.min(
					this.slider.maxTop,
					this.slider.top + ((e.pageY||this.pointer.top) - this.pointer.top)
				)
			);
			this.slider.knob.left = left + 'px';
			this.slider.knob.top = top + 'px';
			if (this.slider.callLeft) {
				this.color[this.slider.callLeft].call(this.color, left/100);
			}
			if (this.slider.callTop) {
				this.color[this.slider.callTop].call(this.color, top/100);
			}
			this.previewColor();
			this.element.trigger({
				type: 'changeColor',
				color: this.color
			});
			return false;
		},
		
		mouseup: function(e){
			e.stopPropagation();
			e.preventDefault();
			$(document).off({
				mousemove: this.mousemove,
				mouseup: this.mouseup
			});
			return false;
		}
	}

	$.fn.colorpicker = function ( option ) {
		return this.each(function () {
			var $this = $(this),
				data = $this.data('colorpicker'),
				options = typeof option == 'object' && option;
			if (!data) {
				$this.data('colorpicker', (data = new Colorpicker(this, $.extend({}, $.fn.colorpicker.defaults,options))));
			}
			if (typeof option == 'string') data[option]();
		});
	};

	$.fn.colorpicker.defaults = {
	};
	
	$.fn.colorpicker.Constructor = Colorpicker;
	
	var CPGlobal = {
	
		// translate a format from Color object to a string
		translateFormats: {
			'rgb': function(){
				var rgb = this.color.toRGB();
				return 'rgb('+rgb.r+','+rgb.g+','+rgb.b+')';
			},
			
			'rgba': function(){
				var rgb = this.color.toRGB();
				return 'rgba('+rgb.r+','+rgb.g+','+rgb.b+','+rgb.a+')';
			},
			
			'hsl': function(){
				var hsl = this.color.toHSL();
				return 'hsl('+Math.round(hsl.h*360)+','+Math.round(hsl.s*100)+'%,'+Math.round(hsl.l*100)+'%)';
			},
			
			'hsla': function(){
				var hsl = this.color.toHSL();
				return 'hsla('+Math.round(hsl.h*360)+','+Math.round(hsl.s*100)+'%,'+Math.round(hsl.l*100)+'%,'+hsl.a+')';
			},
			
			'hex': function(){
				return  this.color.toHex();
			}
		},
		
		sliders: {
			saturation: {
				maxLeft: 100,
				maxTop: 100,
				callLeft: 'setSaturation',
				callTop: 'setLightness'
			},
			
			hue: {
				maxLeft: 0,
				maxTop: 100,
				callLeft: false,
				callTop: 'setHue'
			},
			
			alpha: {
				maxLeft: 0,
				maxTop: 100,
				callLeft: false,
				callTop: 'setAlpha'
			}
		},
		
		// HSBtoRGB from RaphaelJS
		// https://github.com/DmitryBaranovskiy/raphael/
		RGBtoHSB: function (r, g, b, a){
			r /= 255;
			g /= 255;
			b /= 255;

			var H, S, V, C;
			V = Math.max(r, g, b);
			C = V - Math.min(r, g, b);
			H = (C == 0 ? null :
				 V == r ? (g - b) / C :
				 V == g ? (b - r) / C + 2 :
						  (r - g) / C + 4
				);
			H = ((H + 360) % 6) * 60 / 360;
			S = C == 0 ? 0 : C / V;
			return {h: H||1, s: S, b: V, a: a||1};
		},
		
		HueToRGB: function (p, q, h) {
			if (h < 0)
				h += 1;
			else if (h > 1)
				h -= 1;

			if ((h * 6) < 1)
				return p + (q - p) * h * 6;
			else if ((h * 2) < 1)
				return q;
			else if ((h * 3) < 2)
				return p + (q - p) * ((2 / 3) - h) * 6;
			else
				return p;
		},
	
		HSLtoRGB: function (h, s, l, a)
		{

			if (s < 0)
				s = 0;

			if (l <= 0.5)
				var q = l * (1 + s);
			else
				var q = l + s - (l * s);

			var p = 2 * l - q;

			var tr = h + (1 / 3);
			var tg = h;
			var tb = h - (1 / 3);

			var r = Math.round(CPGlobal.HueToRGB(p, q, tr) * 255);
			var g = Math.round(CPGlobal.HueToRGB(p, q, tg) * 255);
			var b = Math.round(CPGlobal.HueToRGB(p, q, tb) * 255);
			return [r, g, b, a||1];
		},
		
		// a set of RE's that can match strings and generate color tuples.
		// from John Resig color plugin
		// https://github.com/jquery/jquery-color/
		stringParsers: [
			{
				re: /rgba?\(\s*(\d{1,3})\s*,\s*(\d{1,3})\s*,\s*(\d{1,3})\s*(?:,\s*(\d+(?:\.\d+)?)\s*)?\)/,
				parse: function( execResult ) {
					return [
						execResult[ 1 ],
						execResult[ 2 ],
						execResult[ 3 ],
						execResult[ 4 ]
					];
				}
			}, {
				re: /rgba?\(\s*(\d+(?:\.\d+)?)\%\s*,\s*(\d+(?:\.\d+)?)\%\s*,\s*(\d+(?:\.\d+)?)\%\s*(?:,\s*(\d+(?:\.\d+)?)\s*)?\)/,
				parse: function( execResult ) {
					return [
						2.55 * execResult[1],
						2.55 * execResult[2],
						2.55 * execResult[3],
						execResult[ 4 ]
					];
				}
			}, {
				re: /#([a-fA-F0-9]{2})([a-fA-F0-9]{2})([a-fA-F0-9]{2})/,
				parse: function( execResult ) {
					return [
						parseInt( execResult[ 1 ], 16 ),
						parseInt( execResult[ 2 ], 16 ),
						parseInt( execResult[ 3 ], 16 )
					];
				}
			}, {
				re: /#([a-fA-F0-9])([a-fA-F0-9])([a-fA-F0-9])/,
				parse: function( execResult ) {
					return [
						parseInt( execResult[ 1 ] + execResult[ 1 ], 16 ),
						parseInt( execResult[ 2 ] + execResult[ 2 ], 16 ),
						parseInt( execResult[ 3 ] + execResult[ 3 ], 16 )
					];
				}
			}, {
				re: /hsla?\(\s*(\d+(?:\.\d+)?)\s*,\s*(\d+(?:\.\d+)?)\%\s*,\s*(\d+(?:\.\d+)?)\%\s*(?:,\s*(\d+(?:\.\d+)?)\s*)?\)/,
				space: 'hsla',
				parse: function( execResult ) {
					return [
						execResult[1]/360,
						execResult[2] / 100,
						execResult[3] / 100,
						execResult[4]
					];
				}
			}
		],
		template: '<div class="colorpicker dropdown-menu">'+
							'<div class="colorpicker-saturation"><i><b></b></i></div>'+
							'<div class="colorpicker-hue"><i></i></div>'+
							'<div class="colorpicker-alpha"><i></i></div>'+
							'<div class="colorpicker-color"><div /></div>'+
						'</div>'
	};

}( window.jQuery )


/* =========================================================
 * bootstrap-datepicker.js
 * Repo: https://github.com/eternicode/bootstrap-datepicker/
 * Demo: http://eternicode.github.io/bootstrap-datepicker/
 * Docs: http://bootstrap-datepicker.readthedocs.org/
 * Forked from http://www.eyecon.ro/bootstrap-datepicker
 * =========================================================
 * Started by Stefan Petre; improvements by Andrew Rowls + contributors
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 * ========================================================= */

(function($, undefined){

  var $window = $(window);

  function UTCDate(){
    return new Date(Date.UTC.apply(Date, arguments));
  }
  function UTCToday(){
    var today = new Date();
    return UTCDate(today.getFullYear(), today.getMonth(), today.getDate());
  }
  function alias(method){
    return function(){
      return this[method].apply(this, arguments);
    };
  }

  var DateArray = (function(){
    var extras = {
      get: function(i){
        return this.slice(i)[0];
      },
      contains: function(d){
        // Array.indexOf is not cross-browser;
        // $.inArray doesn't work with Dates
        var val = d && d.valueOf();
        for (var i=0, l=this.length; i < l; i++)
          if (this[i].valueOf() === val)
            return i;
        return -1;
      },
      remove: function(i){
        this.splice(i,1);
      },
      replace: function(new_array){
        if (!new_array)
          return;
        if (!$.isArray(new_array))
          new_array = [new_array];
        this.clear();
        this.push.apply(this, new_array);
      },
      clear: function(){
        this.splice(0);
      },
      copy: function(){
        var a = new DateArray();
        a.replace(this);
        return a;
      }
    };

    return function(){
      var a = [];
      a.push.apply(a, arguments);
      $.extend(a, extras);
      return a;
    };
  })();


  // Picker object

  var Datepicker = function(element, options){
    this.dates = new DateArray();
    this.viewDate = UTCToday();
    this.focusDate = null;

    this._process_options(options);

    this.element = $(element);
    this.isInline = false;
    this.isInput = this.element.is('input');
    this.component = this.element.is('.date') ? this.element.find('.add-on, .input-group-addon, .btn') : false;
    this.hasInput = this.component && this.element.find('input').length;
    if (this.component && this.component.length === 0)
      this.component = false;

    this.picker = $(DPGlobal.template);
    this._buildEvents();
    this._attachEvents();

    if (this.isInline){
      this.picker.addClass('datepicker-inline').appendTo(this.element);
    }
    else {
      this.picker.addClass('datepicker-dropdown dropdown-menu');
    }

    if (this.o.rtl){
      this.picker.addClass('datepicker-rtl');
    }

    this.viewMode = this.o.startView;

    if (this.o.calendarWeeks)
      this.picker.find('tfoot th.today')
            .attr('colspan', function(i, val){
              return parseInt(val) + 1;
            });

    this._allow_update = false;

    this.setStartDate(this._o.startDate);
    this.setEndDate(this._o.endDate);
    this.setDaysOfWeekDisabled(this.o.daysOfWeekDisabled);

    this.fillDow();
    this.fillMonths();

    this._allow_update = true;

    this.update();
    this.showMode();

    if (this.isInline){
      this.show();
    }
  };

  Datepicker.prototype = {
    constructor: Datepicker,

    _process_options: function(opts){
      // Store raw options for reference
      this._o = $.extend({}, this._o, opts);
      // Processed options
      var o = this.o = $.extend({}, this._o);

      // Check if "de-DE" style date is available, if not language should
      // fallback to 2 letter code eg "de"
      var lang = o.language;
      if (!dates[lang]){
        lang = lang.split('-')[0];
        if (!dates[lang])
          lang = defaults.language;
      }
      o.language = lang;

      switch (o.startView){
        case 2:
        case 'decade':
          o.startView = 2;
          break;
        case 1:
        case 'year':
          o.startView = 1;
          break;
        default:
          o.startView = 0;
      }

      switch (o.minViewMode){
        case 1:
        case 'months':
          o.minViewMode = 1;
          break;
        case 2:
        case 'years':
          o.minViewMode = 2;
          break;
        default:
          o.minViewMode = 0;
      }

      o.startView = Math.max(o.startView, o.minViewMode);

      // true, false, or Number > 0
      if (o.multidate !== true){
        o.multidate = Number(o.multidate) || false;
        if (o.multidate !== false)
          o.multidate = Math.max(0, o.multidate);
        else
          o.multidate = 1;
      }
      o.multidateSeparator = String(o.multidateSeparator);

      o.weekStart %= 7;
      o.weekEnd = ((o.weekStart + 6) % 7);

      var format = DPGlobal.parseFormat(o.format);
      if (o.startDate !== -Infinity){
        if (!!o.startDate){
          if (o.startDate instanceof Date)
            o.startDate = this._local_to_utc(this._zero_time(o.startDate));
          else
            o.startDate = DPGlobal.parseDate(o.startDate, format, o.language);
        }
        else {
          o.startDate = -Infinity;
        }
      }
      if (o.endDate !== Infinity){
        if (!!o.endDate){
          if (o.endDate instanceof Date)
            o.endDate = this._local_to_utc(this._zero_time(o.endDate));
          else
            o.endDate = DPGlobal.parseDate(o.endDate, format, o.language);
        }
        else {
          o.endDate = Infinity;
        }
      }

      o.daysOfWeekDisabled = o.daysOfWeekDisabled||[];
      if (!$.isArray(o.daysOfWeekDisabled))
        o.daysOfWeekDisabled = o.daysOfWeekDisabled.split(/[,\s]*/);
      o.daysOfWeekDisabled = $.map(o.daysOfWeekDisabled, function(d){
        return parseInt(d, 10);
      });

      var plc = String(o.orientation).toLowerCase().split(/\s+/g),
        _plc = o.orientation.toLowerCase();
      plc = $.grep(plc, function(word){
        return (/^auto|left|right|top|bottom$/).test(word);
      });
      o.orientation = {x: 'auto', y: 'auto'};
      if (!_plc || _plc === 'auto')
        ; // no action
      else if (plc.length === 1){
        switch (plc[0]){
          case 'top':
          case 'bottom':
            o.orientation.y = plc[0];
            break;
          case 'left':
          case 'right':
            o.orientation.x = plc[0];
            break;
        }
      }
      else {
        _plc = $.grep(plc, function(word){
          return (/^left|right$/).test(word);
        });
        o.orientation.x = _plc[0] || 'auto';

        _plc = $.grep(plc, function(word){
          return (/^top|bottom$/).test(word);
        });
        o.orientation.y = _plc[0] || 'auto';
      }
    },
    _events: [],
    _secondaryEvents: [],
    _applyEvents: function(evs){
      for (var i=0, el, ch, ev; i < evs.length; i++){
        el = evs[i][0];
        if (evs[i].length === 2){
          ch = undefined;
          ev = evs[i][1];
        }
        else if (evs[i].length === 3){
          ch = evs[i][1];
          ev = evs[i][2];
        }
        el.on(ev, ch);
      }
    },
    _unapplyEvents: function(evs){
      for (var i=0, el, ev, ch; i < evs.length; i++){
        el = evs[i][0];
        if (evs[i].length === 2){
          ch = undefined;
          ev = evs[i][1];
        }
        else if (evs[i].length === 3){
          ch = evs[i][1];
          ev = evs[i][2];
        }
        el.off(ev, ch);
      }
    },
    _buildEvents: function(){
      if (this.isInput){ // single input
        this._events = [
          [this.element, {
            focus: $.proxy(this.show, this),
            keyup: $.proxy(function(e){
              if ($.inArray(e.keyCode, [27,37,39,38,40,32,13,9]) === -1)
                this.update();
            }, this),
            keydown: $.proxy(this.keydown, this)
          }]
        ];
      }
      else if (this.component && this.hasInput){ // component: input + button
        this._events = [
          // For components that are not readonly, allow keyboard nav
          [this.element.find('input'), {
            focus: $.proxy(this.show, this),
            keyup: $.proxy(function(e){
              if ($.inArray(e.keyCode, [27,37,39,38,40,32,13,9]) === -1)
                this.update();
            }, this),
            keydown: $.proxy(this.keydown, this)
          }],
          [this.component, {
            click: $.proxy(this.show, this)
          }]
        ];
      }
      else if (this.element.is('div')){  // inline datepicker
        this.isInline = true;
      }
      else {
        this._events = [
          [this.element, {
            click: $.proxy(this.show, this)
          }]
        ];
      }
      this._events.push(
        // Component: listen for blur on element descendants
        [this.element, '*', {
          blur: $.proxy(function(e){
            this._focused_from = e.target;
          }, this)
        }],
        // Input: listen for blur on element
        [this.element, {
          blur: $.proxy(function(e){
            this._focused_from = e.target;
          }, this)
        }]
      );

      this._secondaryEvents = [
        [this.picker, {
          click: $.proxy(this.click, this)
        }],
        [$(window), {
          resize: $.proxy(this.place, this)
        }],
        [$(document), {
          'mousedown touchstart': $.proxy(function(e){
            // Clicked outside the datepicker, hide it
            if (!(
              this.element.is(e.target) ||
              this.element.find(e.target).length ||
              this.picker.is(e.target) ||
              this.picker.find(e.target).length
            )){
              this.hide();
            }
          }, this)
        }]
      ];
    },
    _attachEvents: function(){
      this._detachEvents();
      this._applyEvents(this._events);
    },
    _detachEvents: function(){
      this._unapplyEvents(this._events);
    },
    _attachSecondaryEvents: function(){
      this._detachSecondaryEvents();
      this._applyEvents(this._secondaryEvents);
    },
    _detachSecondaryEvents: function(){
      this._unapplyEvents(this._secondaryEvents);
    },
    _trigger: function(event, altdate){
      var date = altdate || this.dates.get(-1),
        local_date = this._utc_to_local(date);

      this.element.trigger({
        type: event,
        date: local_date,
        dates: $.map(this.dates, this._utc_to_local),
        format: $.proxy(function(ix, format){
          if (arguments.length === 0){
            ix = this.dates.length - 1;
            format = this.o.format;
          }
          else if (typeof ix === 'string'){
            format = ix;
            ix = this.dates.length - 1;
          }
          format = format || this.o.format;
          var date = this.dates.get(ix);
          return DPGlobal.formatDate(date, format, this.o.language);
        }, this)
      });
    },

    show: function(){
      if (!this.isInline)
        this.picker.appendTo('body');
      this.picker.show();
      this.place();
      this._attachSecondaryEvents();
      this._trigger('show');
    },

    hide: function(){
      if (this.isInline)
        return;
      if (!this.picker.is(':visible'))
        return;
      this.focusDate = null;
      this.picker.hide().detach();
      this._detachSecondaryEvents();
      this.viewMode = this.o.startView;
      this.showMode();

      if (
        this.o.forceParse &&
        (
          this.isInput && this.element.val() ||
          this.hasInput && this.element.find('input').val()
        )
      )
        this.setValue();
      this._trigger('hide');
    },

    remove: function(){
      this.hide();
      this._detachEvents();
      this._detachSecondaryEvents();
      this.picker.remove();
      delete this.element.data().datepicker;
      if (!this.isInput){
        delete this.element.data().date;
      }
    },

    _utc_to_local: function(utc){
      return utc && new Date(utc.getTime() + (utc.getTimezoneOffset()*60000));
    },
    _local_to_utc: function(local){
      return local && new Date(local.getTime() - (local.getTimezoneOffset()*60000));
    },
    _zero_time: function(local){
      return local && new Date(local.getFullYear(), local.getMonth(), local.getDate());
    },
    _zero_utc_time: function(utc){
      return utc && new Date(Date.UTC(utc.getUTCFullYear(), utc.getUTCMonth(), utc.getUTCDate()));
    },

    getDates: function(){
      return $.map(this.dates, this._utc_to_local);
    },

    getUTCDates: function(){
      return $.map(this.dates, function(d){
        return new Date(d);
      });
    },

    getDate: function(){
      return this._utc_to_local(this.getUTCDate());
    },

    getUTCDate: function(){
      return new Date(this.dates.get(-1));
    },

    setDates: function(){
      var args = $.isArray(arguments[0]) ? arguments[0] : arguments;
      this.update.apply(this, args);
      this._trigger('changeDate');
      this.setValue();
    },

    setUTCDates: function(){
      var args = $.isArray(arguments[0]) ? arguments[0] : arguments;
      this.update.apply(this, $.map(args, this._utc_to_local));
      this._trigger('changeDate');
      this.setValue();
    },

    setDate: alias('setDates'),
    setUTCDate: alias('setUTCDates'),

    setValue: function(){
      var formatted = this.getFormattedDate();
      if (!this.isInput){
        if (this.component){
          this.element.find('input').val(formatted).change();
        }
      }
      else {
        this.element.val(formatted).change();
      }
    },

    getFormattedDate: function(format){
      if (format === undefined)
        format = this.o.format;

      var lang = this.o.language;
      return $.map(this.dates, function(d){
        return DPGlobal.formatDate(d, format, lang);
      }).join(this.o.multidateSeparator);
    },

    setStartDate: function(startDate){
      this._process_options({startDate: startDate});
      this.update();
      this.updateNavArrows();
    },

    setEndDate: function(endDate){
      this._process_options({endDate: endDate});
      this.update();
      this.updateNavArrows();
    },

    setDaysOfWeekDisabled: function(daysOfWeekDisabled){
      this._process_options({daysOfWeekDisabled: daysOfWeekDisabled});
      this.update();
      this.updateNavArrows();
    },

    place: function(){
      if (this.isInline)
        return;
      var calendarWidth = this.picker.outerWidth(),
        calendarHeight = this.picker.outerHeight(),
        visualPadding = 10,
        windowWidth = $window.width(),
        windowHeight = $window.height(),
        scrollTop = $window.scrollTop();

      var zIndex = parseInt(this.element.parents().filter(function(){
          return $(this).css('z-index') !== 'auto';
        }).first().css('z-index'))+10;
      var offset = this.component ? this.component.parent().offset() : this.element.offset();
      var height = this.component ? this.component.outerHeight(true) : this.element.outerHeight(false);
      var width = this.component ? this.component.outerWidth(true) : this.element.outerWidth(false);
      var left = offset.left,
        top = offset.top;

      this.picker.removeClass(
        'datepicker-orient-top datepicker-orient-bottom '+
        'datepicker-orient-right datepicker-orient-left'
      );

      if (this.o.orientation.x !== 'auto'){
        this.picker.addClass('datepicker-orient-' + this.o.orientation.x);
        if (this.o.orientation.x === 'right')
          left -= calendarWidth - width;
      }
      // auto x orientation is best-placement: if it crosses a window
      // edge, fudge it sideways
      else {
        // Default to left
        this.picker.addClass('datepicker-orient-left');
        if (offset.left < 0)
          left -= offset.left - visualPadding;
        else if (offset.left + calendarWidth > windowWidth)
          left = windowWidth - calendarWidth - visualPadding;
      }

      // auto y orientation is best-situation: top or bottom, no fudging,
      // decision based on which shows more of the calendar
      var yorient = this.o.orientation.y,
        top_overflow, bottom_overflow;
      if (yorient === 'auto'){
        top_overflow = -scrollTop + offset.top - calendarHeight;
        bottom_overflow = scrollTop + windowHeight - (offset.top + height + calendarHeight);
        if (Math.max(top_overflow, bottom_overflow) === bottom_overflow)
          yorient = 'top';
        else
          yorient = 'bottom';
      }
      this.picker.addClass('datepicker-orient-' + yorient);
      if (yorient === 'top')
        top += height;
      else
        top -= calendarHeight + parseInt(this.picker.css('padding-top'));

      this.picker.css({
        top: top,
        left: left,
        zIndex: zIndex
      });
    },

    _allow_update: true,
    update: function(){
      if (!this._allow_update)
        return;

      var oldDates = this.dates.copy(),
        dates = [],
        fromArgs = false;
      if (arguments.length){
        $.each(arguments, $.proxy(function(i, date){
          if (date instanceof Date)
            date = this._local_to_utc(date);
          dates.push(date);
        }, this));
        fromArgs = true;
      }
      else {
        dates = this.isInput
            ? this.element.val()
            : this.element.data('date') || this.element.find('input').val();
        if (dates && this.o.multidate)
          dates = dates.split(this.o.multidateSeparator);
        else
          dates = [dates];
        delete this.element.data().date;
      }

      dates = $.map(dates, $.proxy(function(date){
        return DPGlobal.parseDate(date, this.o.format, this.o.language);
      }, this));
      dates = $.grep(dates, $.proxy(function(date){
        return (
          date < this.o.startDate ||
          date > this.o.endDate ||
          !date
        );
      }, this), true);
      this.dates.replace(dates);

      if (this.dates.length)
        this.viewDate = new Date(this.dates.get(-1));
      else if (this.viewDate < this.o.startDate)
        this.viewDate = new Date(this.o.startDate);
      else if (this.viewDate > this.o.endDate)
        this.viewDate = new Date(this.o.endDate);

      if (fromArgs){
        // setting date by clicking
        this.setValue();
      }
      else if (dates.length){
        // setting date by typing
        if (String(oldDates) !== String(this.dates))
          this._trigger('changeDate');
      }
      if (!this.dates.length && oldDates.length)
        this._trigger('clearDate');

      this.fill();
    },

    fillDow: function(){
      var dowCnt = this.o.weekStart,
        html = '<tr>';
      if (this.o.calendarWeeks){
        var cell = '<th class="cw">&nbsp;</th>';
        html += cell;
        this.picker.find('.datepicker-days thead tr:first-child').prepend(cell);
      }
      while (dowCnt < this.o.weekStart + 7){
        html += '<th class="dow">'+dates[this.o.language].daysMin[(dowCnt++)%7]+'</th>';
      }
      html += '</tr>';
      this.picker.find('.datepicker-days thead').append(html);
    },

    fillMonths: function(){
      var html = '',
      i = 0;
      while (i < 12){
        html += '<span class="month">'+dates[this.o.language].monthsShort[i++]+'</span>';
      }
      this.picker.find('.datepicker-months td').html(html);
    },

    setRange: function(range){
      if (!range || !range.length)
        delete this.range;
      else
        this.range = $.map(range, function(d){
          return d.valueOf();
        });
      this.fill();
    },

    getClassNames: function(date){
      var cls = [],
        year = this.viewDate.getUTCFullYear(),
        month = this.viewDate.getUTCMonth(),
        today = new Date();
      if (date.getUTCFullYear() < year || (date.getUTCFullYear() === year && date.getUTCMonth() < month)){
        cls.push('old');
      }
      else if (date.getUTCFullYear() > year || (date.getUTCFullYear() === year && date.getUTCMonth() > month)){
        cls.push('new');
      }
      if (this.focusDate && date.valueOf() === this.focusDate.valueOf())
        cls.push('focused');
      // Compare internal UTC date with local today, not UTC today
      if (this.o.todayHighlight &&
        date.getUTCFullYear() === today.getFullYear() &&
        date.getUTCMonth() === today.getMonth() &&
        date.getUTCDate() === today.getDate()){
        cls.push('today');
      }
      if (this.dates.contains(date) !== -1)
        cls.push('active');
      if (date.valueOf() < this.o.startDate || date.valueOf() > this.o.endDate ||
        $.inArray(date.getUTCDay(), this.o.daysOfWeekDisabled) !== -1){
        cls.push('disabled');
      }
      if (this.range){
        if (date > this.range[0] && date < this.range[this.range.length-1]){
          cls.push('range');
        }
        if ($.inArray(date.valueOf(), this.range) !== -1){
          cls.push('selected');
        }
      }
      return cls;
    },

    fill: function(){
      var d = new Date(this.viewDate),
        year = d.getUTCFullYear(),
        month = d.getUTCMonth(),
        startYear = this.o.startDate !== -Infinity ? this.o.startDate.getUTCFullYear() : -Infinity,
        startMonth = this.o.startDate !== -Infinity ? this.o.startDate.getUTCMonth() : -Infinity,
        endYear = this.o.endDate !== Infinity ? this.o.endDate.getUTCFullYear() : Infinity,
        endMonth = this.o.endDate !== Infinity ? this.o.endDate.getUTCMonth() : Infinity,
        todaytxt = dates[this.o.language].today || dates['en'].today || '',
        cleartxt = dates[this.o.language].clear || dates['en'].clear || '',
        tooltip;
      this.picker.find('.datepicker-days thead th.datepicker-switch')
            .text(dates[this.o.language].months[month]+' '+year);
      this.picker.find('tfoot th.today')
            .text(todaytxt)
            .toggle(this.o.todayBtn !== false);
      this.picker.find('tfoot th.clear')
            .text(cleartxt)
            .toggle(this.o.clearBtn !== false);
      this.updateNavArrows();
      this.fillMonths();
      var prevMonth = UTCDate(year, month-1, 28),
        day = DPGlobal.getDaysInMonth(prevMonth.getUTCFullYear(), prevMonth.getUTCMonth());
      prevMonth.setUTCDate(day);
      prevMonth.setUTCDate(day - (prevMonth.getUTCDay() - this.o.weekStart + 7)%7);
      var nextMonth = new Date(prevMonth);
      nextMonth.setUTCDate(nextMonth.getUTCDate() + 42);
      nextMonth = nextMonth.valueOf();
      var html = [];
      var clsName;
      while (prevMonth.valueOf() < nextMonth){
        if (prevMonth.getUTCDay() === this.o.weekStart){
          html.push('<tr>');
          if (this.o.calendarWeeks){
            // ISO 8601: First week contains first thursday.
            // ISO also states week starts on Monday, but we can be more abstract here.
            var
              // Start of current week: based on weekstart/current date
              ws = new Date(+prevMonth + (this.o.weekStart - prevMonth.getUTCDay() - 7) % 7 * 864e5),
              // Thursday of this week
              th = new Date(Number(ws) + (7 + 4 - ws.getUTCDay()) % 7 * 864e5),
              // First Thursday of year, year from thursday
              yth = new Date(Number(yth = UTCDate(th.getUTCFullYear(), 0, 1)) + (7 + 4 - yth.getUTCDay())%7*864e5),
              // Calendar week: ms between thursdays, div ms per day, div 7 days
              calWeek =  (th - yth) / 864e5 / 7 + 1;
            html.push('<td class="cw">'+ calWeek +'</td>');

          }
        }
        clsName = this.getClassNames(prevMonth);
        clsName.push('day');

        if (this.o.beforeShowDay !== $.noop){
          var before = this.o.beforeShowDay(this._utc_to_local(prevMonth));
          if (before === undefined)
            before = {};
          else if (typeof(before) === 'boolean')
            before = {enabled: before};
          else if (typeof(before) === 'string')
            before = {classes: before};
          if (before.enabled === false)
            clsName.push('disabled');
          if (before.classes)
            clsName = clsName.concat(before.classes.split(/\s+/));
          if (before.tooltip)
            tooltip = before.tooltip;
        }

        clsName = $.unique(clsName);
        html.push('<td class="'+clsName.join(' ')+'"' + (tooltip ? ' title="'+tooltip+'"' : '') + '>'+prevMonth.getUTCDate() + '</td>');
        if (prevMonth.getUTCDay() === this.o.weekEnd){
          html.push('</tr>');
        }
        prevMonth.setUTCDate(prevMonth.getUTCDate()+1);
      }
      this.picker.find('.datepicker-days tbody').empty().append(html.join(''));

      var months = this.picker.find('.datepicker-months')
            .find('th:eq(1)')
              .text(year)
              .end()
            .find('span').removeClass('active');

      $.each(this.dates, function(i, d){
        if (d.getUTCFullYear() === year)
          months.eq(d.getUTCMonth()).addClass('active');
      });

      if (year < startYear || year > endYear){
        months.addClass('disabled');
      }
      if (year === startYear){
        months.slice(0, startMonth).addClass('disabled');
      }
      if (year === endYear){
        months.slice(endMonth+1).addClass('disabled');
      }

      html = '';
      year = parseInt(year/10, 10) * 10;
      var yearCont = this.picker.find('.datepicker-years')
                .find('th:eq(1)')
                  .text(year + '-' + (year + 9))
                  .end()
                .find('td');
      year -= 1;
      var years = $.map(this.dates, function(d){
          return d.getUTCFullYear();
        }),
        classes;
      for (var i = -1; i < 11; i++){
        classes = ['year'];
        if (i === -1)
          classes.push('old');
        else if (i === 10)
          classes.push('new');
        if ($.inArray(year, years) !== -1)
          classes.push('active');
        if (year < startYear || year > endYear)
          classes.push('disabled');
        html += '<span class="' + classes.join(' ') + '">'+year+'</span>';
        year += 1;
      }
      yearCont.html(html);
    },

    updateNavArrows: function(){
      if (!this._allow_update)
        return;

      var d = new Date(this.viewDate),
        year = d.getUTCFullYear(),
        month = d.getUTCMonth();
      switch (this.viewMode){
        case 0:
          if (this.o.startDate !== -Infinity && year <= this.o.startDate.getUTCFullYear() && month <= this.o.startDate.getUTCMonth()){
            this.picker.find('.prev').css({visibility: 'hidden'});
          }
          else {
            this.picker.find('.prev').css({visibility: 'visible'});
          }
          if (this.o.endDate !== Infinity && year >= this.o.endDate.getUTCFullYear() && month >= this.o.endDate.getUTCMonth()){
            this.picker.find('.next').css({visibility: 'hidden'});
          }
          else {
            this.picker.find('.next').css({visibility: 'visible'});
          }
          break;
        case 1:
        case 2:
          if (this.o.startDate !== -Infinity && year <= this.o.startDate.getUTCFullYear()){
            this.picker.find('.prev').css({visibility: 'hidden'});
          }
          else {
            this.picker.find('.prev').css({visibility: 'visible'});
          }
          if (this.o.endDate !== Infinity && year >= this.o.endDate.getUTCFullYear()){
            this.picker.find('.next').css({visibility: 'hidden'});
          }
          else {
            this.picker.find('.next').css({visibility: 'visible'});
          }
          break;
      }
    },

    click: function(e){
      e.preventDefault();
      var target = $(e.target).closest('span, td, th'),
        year, month, day;
      if (target.length === 1){
        switch (target[0].nodeName.toLowerCase()){
          case 'th':
            switch (target[0].className){
              case 'datepicker-switch':
                this.showMode(1);
                break;
              case 'prev':
              case 'next':
                var dir = DPGlobal.modes[this.viewMode].navStep * (target[0].className === 'prev' ? -1 : 1);
                switch (this.viewMode){
                  case 0:
                    this.viewDate = this.moveMonth(this.viewDate, dir);
                    this._trigger('changeMonth', this.viewDate);
                    break;
                  case 1:
                  case 2:
                    this.viewDate = this.moveYear(this.viewDate, dir);
                    if (this.viewMode === 1)
                      this._trigger('changeYear', this.viewDate);
                    break;
                }
                this.fill();
                break;
              case 'today':
                var date = new Date();
                date = UTCDate(date.getFullYear(), date.getMonth(), date.getDate(), 0, 0, 0);

                this.showMode(-2);
                var which = this.o.todayBtn === 'linked' ? null : 'view';
                this._setDate(date, which);
                break;
              case 'clear':
                var element;
                if (this.isInput)
                  element = this.element;
                else if (this.component)
                  element = this.element.find('input');
                if (element)
                  element.val("").change();
                this.update();
                this._trigger('changeDate');
                if (this.o.autoclose)
                  this.hide();
                break;
            }
            break;
          case 'span':
            if (!target.is('.disabled')){
              this.viewDate.setUTCDate(1);
              if (target.is('.month')){
                day = 1;
                month = target.parent().find('span').index(target);
                year = this.viewDate.getUTCFullYear();
                this.viewDate.setUTCMonth(month);
                this._trigger('changeMonth', this.viewDate);
                if (this.o.minViewMode === 1){
                  this._setDate(UTCDate(year, month, day));
                }
              }
              else {
                day = 1;
                month = 0;
                year = parseInt(target.text(), 10)||0;
                this.viewDate.setUTCFullYear(year);
                this._trigger('changeYear', this.viewDate);
                if (this.o.minViewMode === 2){
                  this._setDate(UTCDate(year, month, day));
                }
              }
              this.showMode(-1);
              this.fill();
            }
            break;
          case 'td':
            if (target.is('.day') && !target.is('.disabled')){
              day = parseInt(target.text(), 10)||1;
              year = this.viewDate.getUTCFullYear();
              month = this.viewDate.getUTCMonth();
              if (target.is('.old')){
                if (month === 0){
                  month = 11;
                  year -= 1;
                }
                else {
                  month -= 1;
                }
              }
              else if (target.is('.new')){
                if (month === 11){
                  month = 0;
                  year += 1;
                }
                else {
                  month += 1;
                }
              }
              this._setDate(UTCDate(year, month, day));
            }
            break;
        }
      }
      if (this.picker.is(':visible') && this._focused_from){
        $(this._focused_from).focus();
      }
      delete this._focused_from;
    },

    _toggle_multidate: function(date){
      var ix = this.dates.contains(date);
      if (!date){
        this.dates.clear();
      }
      else if (ix !== -1){
        this.dates.remove(ix);
      }
      else {
        this.dates.push(date);
      }
      if (typeof this.o.multidate === 'number')
        while (this.dates.length > this.o.multidate)
          this.dates.remove(0);
    },

    _setDate: function(date, which){
      if (!which || which === 'date')
        this._toggle_multidate(date && new Date(date));
      if (!which || which  === 'view')
        this.viewDate = date && new Date(date);

      this.fill();
      this.setValue();
      this._trigger('changeDate');
      var element;
      if (this.isInput){
        element = this.element;
      }
      else if (this.component){
        element = this.element.find('input');
      }
      if (element){
        element.change();
      }
      if (this.o.autoclose && (!which || which === 'date')){
        this.hide();
      }
    },

    moveMonth: function(date, dir){
      if (!date)
        return undefined;
      if (!dir)
        return date;
      var new_date = new Date(date.valueOf()),
        day = new_date.getUTCDate(),
        month = new_date.getUTCMonth(),
        mag = Math.abs(dir),
        new_month, test;
      dir = dir > 0 ? 1 : -1;
      if (mag === 1){
        test = dir === -1
          // If going back one month, make sure month is not current month
          // (eg, Mar 31 -> Feb 31 == Feb 28, not Mar 02)
          ? function(){
            return new_date.getUTCMonth() === month;
          }
          // If going forward one month, make sure month is as expected
          // (eg, Jan 31 -> Feb 31 == Feb 28, not Mar 02)
          : function(){
            return new_date.getUTCMonth() !== new_month;
          };
        new_month = month + dir;
        new_date.setUTCMonth(new_month);
        // Dec -> Jan (12) or Jan -> Dec (-1) -- limit expected date to 0-11
        if (new_month < 0 || new_month > 11)
          new_month = (new_month + 12) % 12;
      }
      else {
        // For magnitudes >1, move one month at a time...
        for (var i=0; i < mag; i++)
          // ...which might decrease the day (eg, Jan 31 to Feb 28, etc)...
          new_date = this.moveMonth(new_date, dir);
        // ...then reset the day, keeping it in the new month
        new_month = new_date.getUTCMonth();
        new_date.setUTCDate(day);
        test = function(){
          return new_month !== new_date.getUTCMonth();
        };
      }
      // Common date-resetting loop -- if date is beyond end of month, make it
      // end of month
      while (test()){
        new_date.setUTCDate(--day);
        new_date.setUTCMonth(new_month);
      }
      return new_date;
    },

    moveYear: function(date, dir){
      return this.moveMonth(date, dir*12);
    },

    dateWithinRange: function(date){
      return date >= this.o.startDate && date <= this.o.endDate;
    },

    keydown: function(e){
      if (this.picker.is(':not(:visible)')){
        if (e.keyCode === 27) // allow escape to hide and re-show picker
          this.show();
        return;
      }
      var dateChanged = false,
        dir, newDate, newViewDate,
        focusDate = this.focusDate || this.viewDate;
      switch (e.keyCode){
        case 27: // escape
          if (this.focusDate){
            this.focusDate = null;
            this.viewDate = this.dates.get(-1) || this.viewDate;
            this.fill();
          }
          else
            this.hide();
          e.preventDefault();
          break;
        case 37: // left
        case 39: // right
          if (!this.o.keyboardNavigation)
            break;
          dir = e.keyCode === 37 ? -1 : 1;
          if (e.ctrlKey){
            newDate = this.moveYear(this.dates.get(-1) || UTCToday(), dir);
            newViewDate = this.moveYear(focusDate, dir);
            this._trigger('changeYear', this.viewDate);
          }
          else if (e.shiftKey){
            newDate = this.moveMonth(this.dates.get(-1) || UTCToday(), dir);
            newViewDate = this.moveMonth(focusDate, dir);
            this._trigger('changeMonth', this.viewDate);
          }
          else {
            newDate = new Date(this.dates.get(-1) || UTCToday());
            newDate.setUTCDate(newDate.getUTCDate() + dir);
            newViewDate = new Date(focusDate);
            newViewDate.setUTCDate(focusDate.getUTCDate() + dir);
          }
          if (this.dateWithinRange(newDate)){
            this.focusDate = this.viewDate = newViewDate;
            this.setValue();
            this.fill();
            e.preventDefault();
          }
          break;
        case 38: // up
        case 40: // down
          if (!this.o.keyboardNavigation)
            break;
          dir = e.keyCode === 38 ? -1 : 1;
          if (e.ctrlKey){
            newDate = this.moveYear(this.dates.get(-1) || UTCToday(), dir);
            newViewDate = this.moveYear(focusDate, dir);
            this._trigger('changeYear', this.viewDate);
          }
          else if (e.shiftKey){
            newDate = this.moveMonth(this.dates.get(-1) || UTCToday(), dir);
            newViewDate = this.moveMonth(focusDate, dir);
            this._trigger('changeMonth', this.viewDate);
          }
          else {
            newDate = new Date(this.dates.get(-1) || UTCToday());
            newDate.setUTCDate(newDate.getUTCDate() + dir * 7);
            newViewDate = new Date(focusDate);
            newViewDate.setUTCDate(focusDate.getUTCDate() + dir * 7);
          }
          if (this.dateWithinRange(newDate)){
            this.focusDate = this.viewDate = newViewDate;
            this.setValue();
            this.fill();
            e.preventDefault();
          }
          break;
        case 32: // spacebar
          // Spacebar is used in manually typing dates in some formats.
          // As such, its behavior should not be hijacked.
          break;
        case 13: // enter
          focusDate = this.focusDate || this.dates.get(-1) || this.viewDate;
          this._toggle_multidate(focusDate);
          dateChanged = true;
          this.focusDate = null;
          this.viewDate = this.dates.get(-1) || this.viewDate;
          this.setValue();
          this.fill();
          if (this.picker.is(':visible')){
            e.preventDefault();
            if (this.o.autoclose)
              this.hide();
          }
          break;
        case 9: // tab
          this.focusDate = null;
          this.viewDate = this.dates.get(-1) || this.viewDate;
          this.fill();
          this.hide();
          break;
      }
      if (dateChanged){
        if (this.dates.length)
          this._trigger('changeDate');
        else
          this._trigger('clearDate');
        var element;
        if (this.isInput){
          element = this.element;
        }
        else if (this.component){
          element = this.element.find('input');
        }
        if (element){
          element.change();
        }
      }
    },

    showMode: function(dir){
      if (dir){
        this.viewMode = Math.max(this.o.minViewMode, Math.min(2, this.viewMode + dir));
      }
      this.picker
        .find('>div')
        .hide()
        .filter('.datepicker-'+DPGlobal.modes[this.viewMode].clsName)
          .css('display', 'block');
      this.updateNavArrows();
    }
  };

  var DateRangePicker = function(element, options){
    this.element = $(element);
    this.inputs = $.map(options.inputs, function(i){
      return i.jquery ? i[0] : i;
    });
    delete options.inputs;

    $(this.inputs)
      .datepicker(options)
      .bind('changeDate', $.proxy(this.dateUpdated, this));

    this.pickers = $.map(this.inputs, function(i){
      return $(i).data('datepicker');
    });
    this.updateDates();
  };
  DateRangePicker.prototype = {
    updateDates: function(){
      this.dates = $.map(this.pickers, function(i){
        return i.getUTCDate();
      });
      this.updateRanges();
    },
    updateRanges: function(){
      var range = $.map(this.dates, function(d){
        return d.valueOf();
      });
      $.each(this.pickers, function(i, p){
        p.setRange(range);
      });
    },
    dateUpdated: function(e){
      // `this.updating` is a workaround for preventing infinite recursion
      // between `changeDate` triggering and `setUTCDate` calling.  Until
      // there is a better mechanism.
      if (this.updating)
        return;
      this.updating = true;

      var dp = $(e.target).data('datepicker'),
        new_date = dp.getUTCDate(),
        i = $.inArray(e.target, this.inputs),
        l = this.inputs.length;
      if (i === -1)
        return;

      $.each(this.pickers, function(i, p){
        if (!p.getUTCDate())
          p.setUTCDate(new_date);
      });

      if (new_date < this.dates[i]){
        // Date being moved earlier/left
        while (i >= 0 && new_date < this.dates[i]){
          this.pickers[i--].setUTCDate(new_date);
        }
      }
      else if (new_date > this.dates[i]){
        // Date being moved later/right
        while (i < l && new_date > this.dates[i]){
          this.pickers[i++].setUTCDate(new_date);
        }
      }
      this.updateDates();

      delete this.updating;
    },
    remove: function(){
      $.map(this.pickers, function(p){ p.remove(); });
      delete this.element.data().datepicker;
    }
  };

  function opts_from_el(el, prefix){
    // Derive options from element data-attrs
    var data = $(el).data(),
      out = {}, inkey,
      replace = new RegExp('^' + prefix.toLowerCase() + '([A-Z])');
    prefix = new RegExp('^' + prefix.toLowerCase());
    function re_lower(_,a){
      return a.toLowerCase();
    }
    for (var key in data)
      if (prefix.test(key)){
        inkey = key.replace(replace, re_lower);
        out[inkey] = data[key];
      }
    return out;
  }

  function opts_from_locale(lang){
    // Derive options from locale plugins
    var out = {};
    // Check if "de-DE" style date is available, if not language should
    // fallback to 2 letter code eg "de"
    if (!dates[lang]){
      lang = lang.split('-')[0];
      if (!dates[lang])
        return;
    }
    var d = dates[lang];
    $.each(locale_opts, function(i,k){
      if (k in d)
        out[k] = d[k];
    });
    return out;
  }

  var old = $.fn.datepicker;
  $.fn.datepicker = function(option){
    var args = Array.apply(null, arguments);
    args.shift();
    var internal_return;
    this.each(function(){
      var $this = $(this),
        data = $this.data('datepicker'),
        options = typeof option === 'object' && option;
      if (!data){
        var elopts = opts_from_el(this, 'date'),
          // Preliminary otions
          xopts = $.extend({}, defaults, elopts, options),
          locopts = opts_from_locale(xopts.language),
          // Options priority: js args, data-attrs, locales, defaults
          opts = $.extend({}, defaults, locopts, elopts, options);
        if ($this.is('.input-daterange') || opts.inputs){
          var ropts = {
            inputs: opts.inputs || $this.find('input').toArray()
          };
          $this.data('datepicker', (data = new DateRangePicker(this, $.extend(opts, ropts))));
        }
        else {
          $this.data('datepicker', (data = new Datepicker(this, opts)));
        }
      }
      if (typeof option === 'string' && typeof data[option] === 'function'){
        internal_return = data[option].apply(data, args);
        if (internal_return !== undefined)
          return false;
      }
    });
    if (internal_return !== undefined)
      return internal_return;
    else
      return this;
  };

  var defaults = $.fn.datepicker.defaults = {
    autoclose: false,
    beforeShowDay: $.noop,
    calendarWeeks: false,
    clearBtn: false,
    daysOfWeekDisabled: [],
    endDate: Infinity,
    forceParse: true,
    format: 'mm/dd/yyyy',
    keyboardNavigation: true,
    language: 'en',
    minViewMode: 0,
    multidate: false,
    multidateSeparator: ',',
    orientation: "auto",
    rtl: false,
    startDate: -Infinity,
    startView: 0,
    todayBtn: false,
    todayHighlight: false,
    weekStart: 0
  };
  var locale_opts = $.fn.datepicker.locale_opts = [
    'format',
    'rtl',
    'weekStart'
  ];
  $.fn.datepicker.Constructor = Datepicker;
  var dates = $.fn.datepicker.dates = {
    en: {
      days: ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday"],
      daysShort: ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun"],
      daysMin: ["Su", "Mo", "Tu", "We", "Th", "Fr", "Sa", "Su"],
      months: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
      monthsShort: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
      today: "Today",
      clear: "Clear"
    }
  };

  var DPGlobal = {
    modes: [
      {
        clsName: 'days',
        navFnc: 'Month',
        navStep: 1
      },
      {
        clsName: 'months',
        navFnc: 'FullYear',
        navStep: 1
      },
      {
        clsName: 'years',
        navFnc: 'FullYear',
        navStep: 10
    }],
    isLeapYear: function(year){
      return (((year % 4 === 0) && (year % 100 !== 0)) || (year % 400 === 0));
    },
    getDaysInMonth: function(year, month){
      return [31, (DPGlobal.isLeapYear(year) ? 29 : 28), 31, 30, 31, 30, 31, 31, 30, 31, 30, 31][month];
    },
    validParts: /dd?|DD?|mm?|MM?|yy(?:yy)?/g,
    nonpunctuation: /[^ -\/:-@\[\u3400-\u9fff-`{-~\t\n\r]+/g,
    parseFormat: function(format){
      // IE treats \0 as a string end in inputs (truncating the value),
      // so it's a bad format delimiter, anyway
      var separators = format.replace(this.validParts, '\0').split('\0'),
        parts = format.match(this.validParts);
      if (!separators || !separators.length || !parts || parts.length === 0){
        throw new Error("Invalid date format.");
      }
      return {separators: separators, parts: parts};
    },
    parseDate: function(date, format, language){
      if (!date)
        return undefined;
      if (date instanceof Date)
        return date;
      if (typeof format === 'string')
        format = DPGlobal.parseFormat(format);
      var part_re = /([\-+]\d+)([dmwy])/,
        parts = date.match(/([\-+]\d+)([dmwy])/g),
        part, dir, i;
      if (/^[\-+]\d+[dmwy]([\s,]+[\-+]\d+[dmwy])*$/.test(date)){
        date = new Date();
        for (i=0; i < parts.length; i++){
          part = part_re.exec(parts[i]);
          dir = parseInt(part[1]);
          switch (part[2]){
            case 'd':
              date.setUTCDate(date.getUTCDate() + dir);
              break;
            case 'm':
              date = Datepicker.prototype.moveMonth.call(Datepicker.prototype, date, dir);
              break;
            case 'w':
              date.setUTCDate(date.getUTCDate() + dir * 7);
              break;
            case 'y':
              date = Datepicker.prototype.moveYear.call(Datepicker.prototype, date, dir);
              break;
          }
        }
        return UTCDate(date.getUTCFullYear(), date.getUTCMonth(), date.getUTCDate(), 0, 0, 0);
      }
      parts = date && date.match(this.nonpunctuation) || [];
      date = new Date();
      var parsed = {},
        setters_order = ['yyyy', 'yy', 'M', 'MM', 'm', 'mm', 'd', 'dd'],
        setters_map = {
          yyyy: function(d,v){
            return d.setUTCFullYear(v);
          },
          yy: function(d,v){
            return d.setUTCFullYear(2000+v);
          },
          m: function(d,v){
            if (isNaN(d))
              return d;
            v -= 1;
            while (v < 0) v += 12;
            v %= 12;
            d.setUTCMonth(v);
            while (d.getUTCMonth() !== v)
              d.setUTCDate(d.getUTCDate()-1);
            return d;
          },
          d: function(d,v){
            return d.setUTCDate(v);
          }
        },
        val, filtered;
      setters_map['M'] = setters_map['MM'] = setters_map['mm'] = setters_map['m'];
      setters_map['dd'] = setters_map['d'];
      date = UTCDate(date.getFullYear(), date.getMonth(), date.getDate(), 0, 0, 0);
      var fparts = format.parts.slice();
      // Remove noop parts
      if (parts.length !== fparts.length){
        fparts = $(fparts).filter(function(i,p){
          return $.inArray(p, setters_order) !== -1;
        }).toArray();
      }
      // Process remainder
      function match_part(){
        var m = this.slice(0, parts[i].length),
          p = parts[i].slice(0, m.length);
        return m === p;
      }
      if (parts.length === fparts.length){
        var cnt;
        for (i=0, cnt = fparts.length; i < cnt; i++){
          val = parseInt(parts[i], 10);
          part = fparts[i];
          if (isNaN(val)){
            switch (part){
              case 'MM':
                filtered = $(dates[language].months).filter(match_part);
                val = $.inArray(filtered[0], dates[language].months) + 1;
                break;
              case 'M':
                filtered = $(dates[language].monthsShort).filter(match_part);
                val = $.inArray(filtered[0], dates[language].monthsShort) + 1;
                break;
            }
          }
          parsed[part] = val;
        }
        var _date, s;
        for (i=0; i < setters_order.length; i++){
          s = setters_order[i];
          if (s in parsed && !isNaN(parsed[s])){
            _date = new Date(date);
            setters_map[s](_date, parsed[s]);
            if (!isNaN(_date))
              date = _date;
          }
        }
      }
      return date;
    },
    formatDate: function(date, format, language){
      if (!date)
        return '';
      if (typeof format === 'string')
        format = DPGlobal.parseFormat(format);
      var val = {
        d: date.getUTCDate(),
        D: dates[language].daysShort[date.getUTCDay()],
        DD: dates[language].days[date.getUTCDay()],
        m: date.getUTCMonth() + 1,
        M: dates[language].monthsShort[date.getUTCMonth()],
        MM: dates[language].months[date.getUTCMonth()],
        yy: date.getUTCFullYear().toString().substring(2),
        yyyy: date.getUTCFullYear()
      };
      val.dd = (val.d < 10 ? '0' : '') + val.d;
      val.mm = (val.m < 10 ? '0' : '') + val.m;
      date = [];
      var seps = $.extend([], format.separators);
      for (var i=0, cnt = format.parts.length; i <= cnt; i++){
        if (seps.length)
          date.push(seps.shift());
        date.push(val[format.parts[i]]);
      }
      return date.join('');
    },
    headTemplate: '<thead>'+
              '<tr>'+
                '<th class="prev">&laquo;</th>'+
                '<th colspan="5" class="datepicker-switch"></th>'+
                '<th class="next">&raquo;</th>'+
              '</tr>'+
            '</thead>',
    contTemplate: '<tbody><tr><td colspan="7"></td></tr></tbody>',
    footTemplate: '<tfoot>'+
              '<tr>'+
                '<th colspan="7" class="today"></th>'+
              '</tr>'+
              '<tr>'+
                '<th colspan="7" class="clear"></th>'+
              '</tr>'+
            '</tfoot>'
  };
  DPGlobal.template = '<div class="datepicker">'+
              '<div class="datepicker-days">'+
                '<table class=" table-condensed">'+
                  DPGlobal.headTemplate+
                  '<tbody></tbody>'+
                  DPGlobal.footTemplate+
                '</table>'+
              '</div>'+
              '<div class="datepicker-months">'+
                '<table class="table-condensed">'+
                  DPGlobal.headTemplate+
                  DPGlobal.contTemplate+
                  DPGlobal.footTemplate+
                '</table>'+
              '</div>'+
              '<div class="datepicker-years">'+
                '<table class="table-condensed">'+
                  DPGlobal.headTemplate+
                  DPGlobal.contTemplate+
                  DPGlobal.footTemplate+
                '</table>'+
              '</div>'+
            '</div>';

  $.fn.datepicker.DPGlobal = DPGlobal;


  /* DATEPICKER NO CONFLICT
  * =================== */

  $.fn.datepicker.noConflict = function(){
    $.fn.datepicker = old;
    return this;
  };


  /* DATEPICKER DATA-API
  * ================== */

  $(document).on(
    'focus.datepicker.data-api click.datepicker.data-api',
    '[data-provide="datepicker"]',
    function(e){
      var $this = $(this);
      if ($this.data('datepicker'))
        return;
      e.preventDefault();
      // component click requires us to explicitly show it
      $this.datepicker('show');
    }
  );
  $(function(){
    $('[data-provide="datepicker-inline"]').datepicker();
  });

}(window.jQuery));