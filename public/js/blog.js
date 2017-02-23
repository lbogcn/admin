!function (a) {
    if ("function" == typeof define && define.amd && define("uikit", function () {
            var f = window.UIkit || a(window, window.jQuery, window.document);
            return f.load = function (a, b, g, e) {
                a = a.split(",");
                var d = [], k = (e.config && e.config.uikit && e.config.uikit.base ? e.config.uikit.base : "").replace(/\/+$/g, "");
                if (!k)throw Error("Please define base path to UIkit in the requirejs config.");
                for (e = 0; e < a.length; e += 1) {
                    var l = a[e].replace(/\./g, "/");
                    d.push(k + "/components/" + l)
                }
                b(d, function () {
                    g(f)
                })
            }, f
        }), !window.jQuery)throw Error("UIkit requires jQuery");
    window && window.jQuery && a(window, window.jQuery, window.document)
}(function (a, f, c) {
    var b = {}, g = a.UIkit ? Object.create(a.UIkit) : void 0;
    if (b.version = "2.25.0", b.noConflict = function () {
            return g && (a.UIkit = g, f.UIkit = g, f.fn.uk = g.fn), b
        }, b.prefix = function (a) {
            return a
        }, b.$ = f, b.$doc = b.$(document), b.$win = b.$(window), b.$html = b.$("html"), b.support = {}, b.support.transition = function () {
            var a;
            a:{
                var b = c.body || c.documentElement, d = {
                    WebkitTransition: "webkitTransitionEnd",
                    MozTransition: "transitionend",
                    OTransition: "oTransitionEnd otransitionend",
                    transition: "transitionend"
                };
                for (a in d)if (void 0 !== b.style[a]) {
                    a = d[a];
                    break a
                }
                a = void 0
            }
            return a && {end: a}
        }(), b.support.animation = function () {
            var a;
            a:{
                var b = c.body || c.documentElement, d = {
                    WebkitAnimation: "webkitAnimationEnd",
                    MozAnimation: "animationend",
                    OAnimation: "oAnimationEnd oanimationend",
                    animation: "animationend"
                };
                for (a in d)if (void 0 !== b.style[a]) {
                    a = d[a];
                    break a
                }
                a = void 0
            }
            return a && {end: a}
        }(), function () {
            Date.now = Date.now || function () {
                    return (new Date).getTime()
                };
            for (var a = ["webkit", "moz"], b = 0; b < a.length && !window.requestAnimationFrame; ++b) {
                var d = a[b];
                window.requestAnimationFrame = window[d + "RequestAnimationFrame"];
                window.cancelAnimationFrame = window[d + "CancelAnimationFrame"] || window[d + "CancelRequestAnimationFrame"]
            }
            if (/iP(ad|hone|od).*OS 6/.test(window.navigator.userAgent) || !window.requestAnimationFrame || !window.cancelAnimationFrame) {
                var h = 0;
                window.requestAnimationFrame = function (a) {
                    var b = Date.now(), k = Math.max(h + 16, b);
                    return setTimeout(function () {
                        a(h = k)
                    }, k - b)
                };
                window.cancelAnimationFrame = clearTimeout
            }
        }(),
            b.support.touch = "ontouchstart" in document || a.DocumentTouch && document instanceof a.DocumentTouch || a.navigator.msPointerEnabled && 0 < a.navigator.msMaxTouchPoints || a.navigator.pointerEnabled && 0 < a.navigator.maxTouchPoints || !1, b.support.mutationobserver = a.MutationObserver || a.WebKitMutationObserver || null, b.Utils = {}, b.Utils.isFullscreen = function () {
            return document.webkitFullscreenElement || document.mozFullScreenElement || document.msFullscreenElement || document.fullscreenElement || !1
        }, b.Utils.str2json = function (a,
                                        b) {
            try {
                return b ? JSON.parse(a.replace(/([\$\w]+)\s*:/g, function (a, b) {
                        return '"' + b + '":'
                    }).replace(/'([^']+)'/g, function (a, b) {
                        return '"' + b + '"'
                    })) : (new Function("", "var json = " + a + "; return JSON.parse(JSON.stringify(json));"))()
            } catch (d) {
                return !1
            }
        }, b.Utils.debounce = function (a, b, d) {
            var h;
            return function () {
                var e = this, c = arguments, g = d && !h;
                clearTimeout(h);
                h = setTimeout(function () {
                    h = null;
                    d || a.apply(e, c)
                }, b);
                g && a.apply(e, c)
            }
        }, b.Utils.removeCssRules = function (a) {
            var b, d, h, e, c, g, f, q, u, v;
            a && setTimeout(function () {
                try {
                    for (v =
                             document.styleSheets, e = 0, f = v.length; f > e; e++) {
                        h = v[e];
                        d = [];
                        h.cssRules = h.cssRules;
                        b = c = 0;
                        for (q = h.cssRules.length; q > c; b = ++c)h.cssRules[b].type === CSSRule.STYLE_RULE && a.test(h.cssRules[b].selectorText) && d.unshift(b);
                        g = 0;
                        for (u = d.length; u > g; g++)h.deleteRule(d[g])
                    }
                } catch (w) {
                }
            }, 0)
        }, b.Utils.isInView = function (a, d) {
            var e = f(a);
            if (!e.is(":visible"))return !1;
            var h = b.$win.scrollLeft(), c = b.$win.scrollTop(), g = e.offset(), n = g.left, g = g.top;
            return d = f.extend({topoffset: 0, leftoffset: 0}, d), g + e.height() >= c && g - d.topoffset <=
            c + b.$win.height() && n + e.width() >= h && n - d.leftoffset <= h + b.$win.width() ? !0 : !1
        }, b.Utils.checkDisplay = function (a, d) {
            var e = b.$("[data-uk-margin], [data-uk-grid-match], [data-uk-grid-margin], [data-uk-check-display]", a || document);
            return a && !e.length && (e = f(a)), e.trigger("display.uk.check"), d && ("string" != typeof d && (d = '[class*="uk-animation-"]'), e.find(d).each(function () {
                var a = b.$(this), k = a.attr("class").match(/uk\-animation\-(.+)/);
                a.removeClass(k[0]).width();
                a.addClass(k[0])
            })), e
        }, b.Utils.options = function (a) {
            if ("string" !=
                f.type(a))return a;
            -1 != a.indexOf(":") && "}" != a.trim().substr(-1) && (a = "{" + a + "}");
            var d = a ? a.indexOf("{") : -1, e = {};
            if (-1 != d)try {
                e = b.Utils.str2json(a.substr(d))
            } catch (h) {
            }
            return e
        }, b.Utils.animate = function (a, d) {
            var e = f.Deferred();
            return a = b.$(a), a.css("display", "none").addClass(d).one(b.support.animation.end, function () {
                a.removeClass(d);
                e.resolve()
            }), a.css("display", ""), e.promise()
        }, b.Utils.uid = function (a) {
            return (a || "id") + (new Date).getTime() + "RAND" + Math.ceil(1E5 * Math.random())
        }, b.Utils.template = function (a,
                                        b) {
            for (var d, h, e, c, g = a.replace(/\n/g, "\\n").replace(/\{\{\{\s*(.+?)\s*\}\}\}/g, "{{!$1}}").split(/(\{\{\s*(.+?)\s*\}\})/g), f = 0, q = [], u = 0; f < g.length;) {
                if (d = g[f], d.match(/\{\{\s*(.+?)\s*\}\}/))switch (f += 1, d = g[f], h = d[0], e = d.substring(d.match(/^(\^|\#|\!|\~|\:)/) ? 1 : 0), h) {
                    case "~":
                        q.push("for(var $i=0;$i<" + e + ".length;$i++) { var $item = " + e + "[$i];");
                        u++;
                        break;
                    case ":":
                        q.push("for(var $key in " + e + ") { var $val = " + e + "[$key];");
                        u++;
                        break;
                    case "#":
                        q.push("if(" + e + ") {");
                        u++;
                        break;
                    case "^":
                        q.push("if(!" + e + ") {");
                        u++;
                        break;
                    case "/":
                        q.push("}");
                        u--;
                        break;
                    case "!":
                        q.push("__ret.push(" + e + ");");
                        break;
                    default:
                        q.push("__ret.push(escape(" + e + "));")
                } else q.push("__ret.push('" + d.replace(/\'/g, "\\'") + "');");
                f += 1
            }
            return c = new Function("$data", ["var __ret = [];\ntry {\nwith($data){", u ? '__ret = ["Not all blocks are closed correctly."]' : q.join(""), "};\n}catch(e){__ret = [e.message];}\nreturn __ret.join(\"\").replace(/\\n\\n/g, \"\\n\");\nfunction escape(html) { return String(html).replace(/&/g, '&amp;').replace(/\"/g, '&quot;').replace(/</g, '&lt;').replace(/>/g, '&gt;');}"].join("\n")),
                b ? c(b) : c
        }, b.Utils.events = {}, b.Utils.events.click = b.support.touch ? "tap" : "click", a.UIkit = b, b.fn = function (a, d) {
            var e = arguments, h = a.match(/^([a-z\-]+)(?:\.([a-z]+))?/i), c = h[1], g = h[2];
            return b[c] ? this.each(function () {
                    var a = f(this), k = a.data(c);
                    k || a.data(c, k = b[c](this, g ? void 0 : d));
                    g && k[g].apply(k, Array.prototype.slice.call(e, 1))
                }) : (f.error("UIkit component [" + c + "] does not exist."), this)
        }, f.UIkit = b, f.fn.uk = b.fn, b.langdirection = "rtl" == b.$html.attr("dir") ? "right" : "left", b.components = {}, b.component = function (a,
                                                                                                                                                      d) {
            var e = function (d, c) {
                var g = this;
                return this.UIkit = b, this.element = d ? b.$(d) : null, this.options = f.extend(!0, {}, this.defaults, c), this.plugins = {}, this.element && this.element.data(a, this), this.init(), (this.options.plugins.length ? this.options.plugins : Object.keys(e.plugins)).forEach(function (a) {
                    e.plugins[a].init && (e.plugins[a].init(g), g.plugins[a] = !0)
                }), this.trigger("init.uk.component", [a, this]), this
            };
            return e.plugins = {}, f.extend(!0, e.prototype, {
                defaults: {plugins: []}, boot: function () {
                }, init: function () {
                }, on: function (a,
                                 k, d) {
                    return b.$(this.element || this).on(a, k, d)
                }, one: function (a, k, d) {
                    return b.$(this.element || this).one(a, k, d)
                }, off: function (a) {
                    return b.$(this.element || this).off(a)
                }, trigger: function (a, k) {
                    return b.$(this.element || this).trigger(a, k)
                }, find: function (a) {
                    return b.$(this.element ? this.element : []).find(a)
                }, proxy: function (a, b) {
                    var k = this;
                    b.split(" ").forEach(function (b) {
                        k[b] || (k[b] = function () {
                            return a[b].apply(a, arguments)
                        })
                    })
                }, mixin: function (a, b) {
                    var k = this;
                    b.split(" ").forEach(function (b) {
                        k[b] || (k[b] = a[b].bind(k))
                    })
                },
                option: function () {
                    return 1 == arguments.length ? this.options[arguments[0]] || void 0 : (2 == arguments.length && (this.options[arguments[0]] = arguments[1]), void 0)
                }
            }, d), this.components[a] = e, this[a] = function () {
                var d, e;
                if (arguments.length)switch (arguments.length) {
                    case 1:
                        "string" == typeof arguments[0] || arguments[0].nodeType || arguments[0] instanceof jQuery ? d = f(arguments[0]) : e = arguments[0];
                        break;
                    case 2:
                        d = f(arguments[0]), e = arguments[1]
                }
                return d && d.data(a) ? d.data(a) : new b.components[a](d, e)
            }, b.domready && b.component.boot(a),
                e
        }, b.plugin = function (a, b, d) {
            this.components[a].plugins[b] = d
        }, b.component.boot = function (a) {
            b.components[a].prototype && b.components[a].prototype.boot && !b.components[a].booted && (b.components[a].prototype.boot.apply(b, []), b.components[a].booted = !0)
        }, b.component.bootComponents = function () {
            for (var a in b.components)b.component.boot(a)
        }, b.domObservers = [], b.domready = !1, b.ready = function (a) {
            b.domObservers.push(a);
            b.domready && a(document)
        }, b.on = function (a, d, e) {
            return a && -1 < a.indexOf("ready.uk.dom") && b.domready &&
            d.apply(b.$doc), b.$doc.on(a, d, e)
        }, b.one = function (a, d, e) {
            return a && -1 < a.indexOf("ready.uk.dom") && b.domready ? (d.apply(b.$doc), b.$doc) : b.$doc.one(a, d, e)
        }, b.trigger = function (a, d) {
            return b.$doc.trigger(a, d)
        }, b.domObserve = function (a, d) {
            b.support.mutationobserver && (d = d || function () {
                }, b.$(a).each(function () {
                var a = this, k = b.$(a);
                if (!k.data("observer"))try {
                    var e = new b.support.mutationobserver(b.Utils.debounce(function () {
                        d.apply(a, []);
                        k.trigger("changed.uk.dom")
                    }, 50));
                    e.observe(a, {childList: !0, subtree: !0});
                    k.data("observer",
                        e)
                } catch (c) {
                }
            }))
        }, b.init = function (a) {
            a = a || document;
            b.domObservers.forEach(function (b) {
                b(a)
            })
        }, b.on("domready.uk.dom", function () {
            b.init();
            b.domready && b.Utils.checkDisplay()
        }), document.addEventListener("DOMContentLoaded", function () {
            var a = function () {
                b.$body = b.$("body");
                b.ready(function () {
                    b.domObserve("[data-uk-observe]")
                });
                b.on("changed.uk.dom", function (a) {
                    b.init(a.target);
                    b.Utils.checkDisplay(a.target)
                });
                b.trigger("beforeready.uk.dom");
                b.component.bootComponents();
                requestAnimationFrame(function () {
                    var a =
                        0, d = 0, k = window.pageXOffset, e = window.pageYOffset, c = function () {
                        var g = window.pageXOffset, f = window.pageYOffset;
                        k == g && e == f || (a = g != k ? g > k ? 1 : -1 : 0, d = f != e ? f > e ? 1 : -1 : 0, k = g, e = f, b.$doc.trigger("scrolling.uk.document", [{
                            dir: {
                                x: a,
                                y: d
                            }, x: g, y: f
                        }]));
                        requestAnimationFrame(c)
                    };
                    return b.support.touch && b.$html.on("touchmove touchend MSPointerMove MSPointerUp pointermove pointerup", c), (k || e) && c(), c
                }());
                b.trigger("domready.uk.dom");
                b.support.touch && navigator.userAgent.match(/(iPad|iPhone|iPod)/g) && b.$win.on("load orientationchange resize",
                    b.Utils.debounce(function () {
                        var a = function () {
                            return f(".uk-height-viewport").css("height", window.innerHeight), a
                        };
                        return a()
                    }(), 100));
                b.trigger("afterready.uk.dom");
                b.domready = !0
            };
            return ("complete" == document.readyState || "interactive" == document.readyState) && setTimeout(a), a
        }()), b.$html.addClass(b.support.touch ? "uk-touch" : "uk-notouch"), b.support.touch) {
        var e, d = !1;
        b.$html.on("mouseenter touchstart MSPointerDown pointerdown", ".uk-overlay, .uk-overlay-hover, .uk-overlay-toggle, .uk-animation-hover, .uk-has-hover",
            function () {
                d && f(".uk-hover").removeClass("uk-hover");
                d = f(this).addClass("uk-hover")
            }).on("mouseleave touchend MSPointerUp pointerup", function (a) {
            e = f(a.target).parents(".uk-overlay, .uk-overlay-hover, .uk-overlay-toggle, .uk-animation-hover, .uk-has-hover");
            d && d.not(e).removeClass("uk-hover")
        })
    }
    return b
});
(function (a) {
    function f(a, b, d, k) {
        return Math.abs(a - b) >= Math.abs(d - k) ? 0 < a - b ? "Left" : "Right" : 0 < d - k ? "Up" : "Down"
    }

    function c() {
        l = null;
        h.last && (void 0 !== h.el && h.el.trigger("longTap"), h = {})
    }

    function b() {
        e && clearTimeout(e);
        d && clearTimeout(d);
        k && clearTimeout(k);
        l && clearTimeout(l);
        e = d = k = l = null;
        h = {}
    }

    function g(a) {
        return a.pointerType == a.MSPOINTER_TYPE_TOUCH && a.isPrimary
    }

    if (!a.fn.swipeLeft) {
        var e, d, k, l, p, h = {};
        a(function () {
            var m, r, n, t = 0, q = 0;
            "MSGesture" in window && (p = new MSGesture, p.target = document.body);
            a(document).on("MSGestureEnd gestureend",
                function (a) {
                    (a = 1 < a.originalEvent.velocityX ? "Right" : -1 > a.originalEvent.velocityX ? "Left" : 1 < a.originalEvent.velocityY ? "Down" : -1 > a.originalEvent.velocityY ? "Up" : null) && void 0 !== h.el && (h.el.trigger("swipe"), h.el.trigger("swipe" + a))
                }).on("touchstart MSPointerDown pointerdown", function (b) {
                ("MSPointerDown" != b.type || g(b.originalEvent)) && (n = "MSPointerDown" == b.type || "pointerdown" == b.type ? b : b.originalEvent.touches[0], m = Date.now(), r = m - (h.last || m), h.el = a("tagName" in n.target ? n.target : n.target.parentNode), e && clearTimeout(e),
                    h.x1 = n.pageX, h.y1 = n.pageY, 0 < r && 250 >= r && (h.isDoubleTap = !0), h.last = m, l = setTimeout(c, 750), !p || "MSPointerDown" != b.type && "pointerdown" != b.type && "touchstart" != b.type || p.addPointer(b.originalEvent.pointerId))
            }).on("touchmove MSPointerMove pointermove", function (a) {
                if ("MSPointerMove" != a.type || g(a.originalEvent)) n = "MSPointerMove" == a.type || "pointermove" == a.type ? a : a.originalEvent.touches[0], l && clearTimeout(l), l = null, h.x2 = n.pageX, h.y2 = n.pageY, t += Math.abs(h.x1 - h.x2), q += Math.abs(h.y1 - h.y2)
            }).on("touchend MSPointerUp pointerup",
                function (c) {
                    if ("MSPointerUp" != c.type || g(c.originalEvent)) l && clearTimeout(l), l = null, h.x2 && 30 < Math.abs(h.x1 - h.x2) || h.y2 && 30 < Math.abs(h.y1 - h.y2) ? k = setTimeout(function () {
                            void 0 !== h.el && (h.el.trigger("swipe"), h.el.trigger("swipe" + f(h.x1, h.x2, h.y1, h.y2)));
                            h = {}
                        }, 0) : "last" in h && (isNaN(t) || 30 > t && 30 > q ? d = setTimeout(function () {
                                var d = a.Event("tap");
                                d.cancelTouch = b;
                                void 0 !== h.el && h.el.trigger(d);
                                h.isDoubleTap ? (void 0 !== h.el && h.el.trigger("doubleTap"), h = {}) : e = setTimeout(function () {
                                        e = null;
                                        void 0 !== h.el && h.el.trigger("singleTap");
                                        h = {}
                                    }, 250)
                            }, 0) : h = {}, t = q = 0)
                }).on("touchcancel MSPointerCancel", b);
            a(window).on("scroll", b)
        });
        "swipe swipeLeft swipeRight swipeUp swipeDown doubleTap tap singleTap longTap".split(" ").forEach(function (b) {
            a.fn[b] = function (d) {
                return a(this).on(b, d)
            }
        })
    }
})(jQuery);
(function (a) {
    var f = [];
    a.component("stackMargin", {
        defaults: {cls: "uk-margin-small-top", rowfirst: !1}, boot: function () {
            a.ready(function (c) {
                a.$("[data-uk-margin]", c).each(function () {
                    var b = a.$(this);
                    b.data("stackMargin") || a.stackMargin(b, a.Utils.options(b.attr("data-uk-margin")))
                })
            })
        }, init: function () {
            var c = this;
            a.$win.on("resize orientationchange", function () {
                var b = function () {
                    c.process()
                };
                return a.$(function () {
                    b();
                    a.$win.on("load", b)
                }), a.Utils.debounce(b, 20)
            }());
            a.$html.on("changed.uk.dom", function () {
                c.process()
            });
            this.on("display.uk.check", function () {
                this.element.is(":visible") && this.process()
            }.bind(this));
            f.push(this)
        }, process: function () {
            var c = this, b = this.element.children();
            if (a.Utils.stackMargin(b, this.options), !this.options.rowfirst)return this;
            var g = b.removeClass(this.options.rowfirst).filter(":visible").first().position();
            return g && b.each(function () {
                a.$(this)[a.$(this).position().left == g.left ? "addClass" : "removeClass"](c.options.rowfirst)
            }), this
        }
    });
    (function () {
        var c = [], b = function (a) {
            if (a.is(":visible")) {
                var b =
                    a.parent().width(), d = a.data("width"), k = Math.floor(b / d * a.data("height"));
                a.css({height: d > b ? k : a.data("height")})
            }
        };
        a.component("responsiveElement", {
            defaults: {}, boot: function () {
                a.ready(function (b) {
                    a.$("iframe.uk-responsive-width, [data-uk-responsive]", b).each(function () {
                        var b = a.$(this);
                        b.data("responsiveElement") || a.responsiveElement(b, {})
                    })
                })
            }, init: function () {
                var a = this.element;
                a.attr("width") && a.attr("height") && (a.data({
                    width: a.attr("width"),
                    height: a.attr("height")
                }).on("display.uk.check", function () {
                    b(a)
                }),
                    b(a), c.push(a))
            }
        });
        a.$win.on("resize load", a.Utils.debounce(function () {
            c.forEach(function (a) {
                b(a)
            })
        }, 15))
    })();
    a.Utils.stackMargin = function (c, b) {
        b = a.$.extend({cls: "uk-margin-small-top"}, b);
        b.cls = b.cls;
        c = a.$(c).removeClass(b.cls);
        var g = !1, e = c.filter(":visible:first"), d = e.length ? e.position().top + e.outerHeight() - 1 : !1;
        !1 !== d && 1 != c.length && c.each(function () {
            var k = a.$(this);
            k.is(":visible") && (g ? k.addClass(b.cls) : k.position().top >= d && (g = k.addClass(b.cls)))
        })
    };
    a.Utils.matchHeights = function (c, b) {
        c = a.$(c).css("min-height",
            "");
        b = a.$.extend({row: !0}, b);
        var g = function (b) {
            if (!(2 > b.length)) {
                var d = 0;
                b.each(function () {
                    d = Math.max(d, a.$(this).outerHeight())
                }).each(function () {
                    var b = a.$(this), e = d - ("border-box" == b.css("box-sizing") ? 0 : b.outerHeight() - b.height());
                    b.css("min-height", e + "px")
                })
            }
        };
        b.row ? (c.first().width(), setTimeout(function () {
                var b = !1, d = [];
                c.each(function () {
                    var k = a.$(this), c = k.offset().top;
                    c != b && d.length && (g(a.$(d)), d = [], c = k.offset().top);
                    d.push(k);
                    b = c
                });
                d.length && g(a.$(d))
            }, 0)) : g(c)
    };
    (function (c) {
        a.Utils.inlineSvg =
            function (b, g) {
                a.$(b || 'img[src$=".svg"]', g || document).each(function () {
                    var b = a.$(this), d = b.attr("src");
                    if (!c[d]) {
                        var k = a.$.Deferred();
                        a.$.get(d, {nc: Math.random()}, function (b) {
                            k.resolve(a.$(b).find("svg"))
                        });
                        c[d] = k.promise()
                    }
                    c[d].then(function (d) {
                        d = a.$(d).clone();
                        b.attr("id") && d.attr("id", b.attr("id"));
                        b.attr("class") && d.attr("class", b.attr("class"));
                        b.attr("style") && d.attr("style", b.attr("style"));
                        b.attr("width") && (d.attr("width", b.attr("width")), b.attr("height") || d.removeAttr("height"));
                        b.attr("height") &&
                        (d.attr("height", b.attr("height")), b.attr("width") || d.removeAttr("width"));
                        b.replaceWith(d)
                    })
                })
            };
        a.ready(function (b) {
            a.Utils.inlineSvg("[data-uk-svg]", b)
        })
    })({})
})(UIkit);
(function (a) {
    function f(c, b) {
        b = a.$.extend({
            duration: 1E3, transition: "easeOutExpo", offset: 0, complete: function () {
            }
        }, b);
        var g = c.offset().top - b.offset, e = a.$doc.height(), d = window.innerHeight;
        g + d > e && (g = e - d);
        a.$("html,body").stop().animate({scrollTop: g}, b.duration, b.transition).promise().done(b.complete)
    }

    a.component("smoothScroll", {
        boot: function () {
            a.$html.on("click.smooth-scroll.uikit", "[data-uk-smooth-scroll]", function () {
                var c = a.$(this);
                c.data("smoothScroll") || (a.smoothScroll(c, a.Utils.options(c.attr("data-uk-smooth-scroll"))),
                    c.trigger("click"));
                return !1
            })
        }, init: function () {
            var c = this;
            this.on("click", function (b) {
                b.preventDefault();
                f(a.$(this.hash).length ? a.$(this.hash) : a.$("body"), c.options)
            })
        }
    });
    a.Utils.scrollToElement = f;
    a.$.easing.easeOutExpo || (a.$.easing.easeOutExpo = function (a, b, g, e, d) {
        return b == d ? g + e : e * (-Math.pow(2, -10 * b / d) + 1) + g
    })
})(UIkit);
(function (a) {
    var f = a.$win, c = a.$doc, b = [], g = function () {
        for (var a = 0; a < b.length; a++)window.requestAnimationFrame.apply(window, [b[a].check])
    };
    a.component("scrollspy", {
        defaults: {
            target: !1,
            cls: "uk-scrollspy-inview",
            initcls: "uk-scrollspy-init-inview",
            topoffset: 0,
            leftoffset: 0,
            repeat: !1,
            delay: 0
        }, boot: function () {
            c.on("scrolling.uk.document", g);
            f.on("load resize orientationchange", a.Utils.debounce(g, 50));
            a.ready(function (b) {
                a.$("[data-uk-scrollspy]", b).each(function () {
                    var b = a.$(this);
                    b.data("scrollspy") || a.scrollspy(b,
                        a.Utils.options(b.attr("data-uk-scrollspy")))
                })
            })
        }, init: function () {
            var d, e = this, c = this.options.cls.split(/,/), h = function () {
                var b = e.options.target ? e.element.find(e.options.target) : e.element, h = 1 === b.length ? 1 : 0, g = 0;
                b.each(function () {
                    var b = a.$(this), f = b.data("inviewstate"), m = a.Utils.isInView(b, e.options), v = b.data("ukScrollspyCls") || c[g].trim();
                    !m || f || b.data("scrollspy-idle") || (d || (b.addClass(e.options.initcls), e.offset = b.offset(), d = !0, b.trigger("init.uk.scrollspy")), b.data("scrollspy-idle", setTimeout(function () {
                        b.addClass("uk-scrollspy-inview").toggleClass(v).width();
                        b.trigger("inview.uk.scrollspy");
                        b.data("scrollspy-idle", !1);
                        b.data("inviewstate", !0)
                    }, e.options.delay * h)), h++);
                    !m && f && e.options.repeat && (b.data("scrollspy-idle") && (clearTimeout(b.data("scrollspy-idle")), b.data("scrollspy-idle", !1)), b.removeClass("uk-scrollspy-inview").toggleClass(v), b.data("inviewstate", !1), b.trigger("outview.uk.scrollspy"));
                    g = c[g + 1] ? g + 1 : 0
                })
            };
            h();
            this.check = h;
            b.push(this)
        }
    });
    var e = [], d = function () {
        for (var a = 0; a < e.length; a++)window.requestAnimationFrame.apply(window, [e[a].check])
    };
    a.component("scrollspynav", {
        defaults: {cls: "uk-active", closest: !1, topoffset: 0, leftoffset: 0, smoothscroll: !1}, boot: function () {
            c.on("scrolling.uk.document", d);
            f.on("resize orientationchange", a.Utils.debounce(d, 50));
            a.ready(function (b) {
                a.$("[data-uk-scrollspy-nav]", b).each(function () {
                    var b = a.$(this);
                    b.data("scrollspynav") || a.scrollspynav(b, a.Utils.options(b.attr("data-uk-scrollspy-nav")))
                })
            })
        }, init: function () {
            var b, d = [], c = this.find("a[href^='#']").each(function () {
                "#" !== this.getAttribute("href").trim() &&
                d.push(this.getAttribute("href"))
            }), h = a.$(d.join(",")), g = this.options.cls, r = this.options.closest || this.options.closest, n = this, t = function () {
                b = [];
                for (var d = 0; d < h.length; d++)a.Utils.isInView(h.eq(d), n.options) && b.push(h.eq(d));
                if (b.length) {
                    var e, d = f.scrollTop();
                    a:{
                        for (var l = 0; l < b.length; l++)if (b[l].offset().top >= d) {
                            d = b[l];
                            break a
                        }
                        d = void 0
                    }
                    d && (n.options.closest ? (c.blur().closest(r).removeClass(g), e = c.filter("a[href='#" + d.attr("id") + "']").closest(r).addClass(g)) : e = c.removeClass(g).filter("a[href='#" + d.attr("id") +
                            "']").addClass(g), n.element.trigger("inview.uk.scrollspynav", [d, e]))
                }
            };
            this.options.smoothscroll && a.smoothScroll && c.each(function () {
                a.smoothScroll(this, n.options.smoothscroll)
            });
            t();
            this.element.data("scrollspynav", this);
            this.check = t;
            e.push(this)
        }
    })
})(UIkit);
(function (a) {
    var f = [];
    a.component("toggle", {
        defaults: {target: !1, cls: "uk-hidden", animation: !1, duration: 200}, boot: function () {
            a.ready(function (c) {
                a.$("[data-uk-toggle]", c).each(function () {
                    var b = a.$(this);
                    b.data("toggle") || a.toggle(b, a.Utils.options(b.attr("data-uk-toggle")))
                });
                setTimeout(function () {
                    f.forEach(function (a) {
                        a.getToggles()
                    })
                }, 0)
            })
        }, init: function () {
            var a = this;
            this.aria = -1 !== this.options.cls.indexOf("uk-hidden");
            this.getToggles();
            this.on("click", function (b) {
                a.element.is('a[href="#"]') && b.preventDefault();
                a.toggle()
            });
            f.push(this)
        }, toggle: function () {
            if (this.totoggle.length) {
                if (this.options.animation && a.support.animation) {
                    var c = this, b = this.options.animation.split(",");
                    1 == b.length && (b[1] = b[0]);
                    b[0] = b[0].trim();
                    b[1] = b[1].trim();
                    this.totoggle.css("animation-duration", this.options.duration + "ms");
                    this.totoggle.each(function () {
                        var g = a.$(this);
                        g.hasClass(c.options.cls) ? (g.toggleClass(c.options.cls), a.Utils.animate(g, b[0]).then(function () {
                                g.css("animation-duration", "");
                                a.Utils.checkDisplay(g)
                            })) : a.Utils.animate(this,
                                b[1] + " uk-animation-reverse").then(function () {
                                g.toggleClass(c.options.cls).css("animation-duration", "");
                                a.Utils.checkDisplay(g)
                            })
                    })
                } else this.totoggle.toggleClass(this.options.cls), a.Utils.checkDisplay(this.totoggle);
                this.updateAria()
            }
        }, getToggles: function () {
            this.totoggle = this.options.target ? a.$(this.options.target) : [];
            this.updateAria()
        }, updateAria: function () {
            this.aria && this.totoggle.length && this.totoggle.each(function () {
                a.$(this).attr("aria-hidden", a.$(this).hasClass("uk-hidden"))
            })
        }
    })
})(UIkit);
(function (a) {
    a.component("alert", {
        defaults: {fade: !0, duration: 200, trigger: ".uk-alert-close"}, boot: function () {
            a.$html.on("click.alert.uikit", "[data-uk-alert]", function (f) {
                var c = a.$(this);
                c.data("alert") || (c = a.alert(c, a.Utils.options(c.attr("data-uk-alert"))), a.$(f.target).is(c.options.trigger) && (f.preventDefault(), c.close()))
            })
        }, init: function () {
            var a = this;
            this.on("click", this.options.trigger, function (c) {
                c.preventDefault();
                a.close()
            })
        }, close: function () {
            var a = this.trigger("close.uk.alert"), c = function () {
                this.trigger("closed.uk.alert").remove()
            }.bind(this);
            this.options.fade ? a.css("overflow", "hidden").css("max-height", a.height()).animate({
                    height: 0,
                    opacity: 0,
                    "padding-top": 0,
                    "padding-bottom": 0,
                    "margin-top": 0,
                    "margin-bottom": 0
                }, this.options.duration, c) : c()
        }
    })
})(UIkit);
(function (a) {
    a.component("buttonRadio", {
        defaults: {activeClass: "uk-active", target: ".uk-button"}, boot: function () {
            a.$html.on("click.buttonradio.uikit", "[data-uk-button-radio]", function (f) {
                var c = a.$(this);
                c.data("buttonRadio") || (c = a.buttonRadio(c, a.Utils.options(c.attr("data-uk-button-radio"))), f = a.$(f.target), f.is(c.options.target) && f.trigger("click"))
            })
        }, init: function () {
            var f = this;
            this.find(f.options.target).attr("aria-checked", "false").filter("." + f.options.activeClass).attr("aria-checked", "true");
            this.on("click", this.options.target, function (c) {
                var b = a.$(this);
                b.is('a[href="#"]') && c.preventDefault();
                f.find(f.options.target).not(b).removeClass(f.options.activeClass).blur();
                b.addClass(f.options.activeClass);
                f.find(f.options.target).not(b).attr("aria-checked", "false");
                b.attr("aria-checked", "true");
                f.trigger("change.uk.button", [b])
            })
        }, getSelected: function () {
            return this.find("." + this.options.activeClass)
        }
    });
    a.component("buttonCheckbox", {
        defaults: {activeClass: "uk-active", target: ".uk-button"}, boot: function () {
            a.$html.on("click.buttoncheckbox.uikit",
                "[data-uk-button-checkbox]", function (f) {
                    var c = a.$(this);
                    c.data("buttonCheckbox") || (c = a.buttonCheckbox(c, a.Utils.options(c.attr("data-uk-button-checkbox"))), f = a.$(f.target), f.is(c.options.target) && f.trigger("click"))
                })
        }, init: function () {
            var f = this;
            this.find(f.options.target).attr("aria-checked", "false").filter("." + f.options.activeClass).attr("aria-checked", "true");
            this.on("click", this.options.target, function (c) {
                var b = a.$(this);
                b.is('a[href="#"]') && c.preventDefault();
                b.toggleClass(f.options.activeClass).blur();
                b.attr("aria-checked", b.hasClass(f.options.activeClass));
                f.trigger("change.uk.button", [b])
            })
        }, getSelected: function () {
            return this.find("." + this.options.activeClass)
        }
    });
    a.component("button", {
        defaults: {}, boot: function () {
            a.$html.on("click.button.uikit", "[data-uk-button]", function () {
                var f = a.$(this);
                f.data("button") || (a.button(f, a.Utils.options(f.attr("data-uk-button"))), f.trigger("click"))
            })
        }, init: function () {
            var a = this;
            this.element.attr("aria-pressed", this.element.hasClass("uk-active"));
            this.on("click",
                function (c) {
                    a.element.is('a[href="#"]') && c.preventDefault();
                    a.toggle();
                    a.trigger("change.uk.button", [a.element.blur().hasClass("uk-active")])
                })
        }, toggle: function () {
            this.element.toggleClass("uk-active");
            this.element.attr("aria-pressed", this.element.hasClass("uk-active"))
        }
    })
})(UIkit);
(function (a) {
    function f(b, d, e, c) {
        if (b = a.$(b), d = a.$(d), e = e || window.innerWidth, c = c || b.offset(), d.length) {
            var g = d.outerWidth();
            (b.css("min-width", g), "right" == a.langdirection) ? (d = e - (d.offset().left + g), e -= b.offset().left + b.outerWidth(), b.css("margin-right", d - e)) : b.css("margin-left", d.offset().left - c.left)
        }
    }

    var c, b = !1, g = {
        "bottom-left": "bottom-right",
        "bottom-right": "bottom-left",
        "bottom-center": "bottom-center",
        "top-left": "top-right",
        "top-right": "top-left",
        "top-center": "top-center",
        "left-top": "right-top",
        "left-bottom": "right-bottom",
        "left-center": "right-center",
        "right-top": "left-top",
        "right-bottom": "left-bottom",
        "right-center": "left-center"
    }, e = {
        "bottom-left": "top-left",
        "bottom-right": "top-right",
        "bottom-center": "top-center",
        "top-left": "bottom-left",
        "top-right": "bottom-right",
        "top-center": "bottom-center",
        "left-top": "left-bottom",
        "left-bottom": "left-top",
        "left-center": "left-center",
        "right-top": "right-bottom",
        "right-bottom": "right-top",
        "right-center": "right-center"
    }, d = {
        "bottom-left": "top-right",
        "bottom-right": "top-left",
        "bottom-center": "top-center",
        "top-left": "bottom-right",
        "top-right": "bottom-left",
        "top-center": "bottom-center",
        "left-top": "right-bottom",
        "left-bottom": "right-top",
        "left-center": "right-center",
        "right-top": "left-bottom",
        "right-bottom": "left-top",
        "right-center": "left-center"
    };
    a.component("dropdown", {
        defaults: {
            mode: "hover",
            pos: "bottom-left",
            offset: 0,
            remaintime: 800,
            justify: !1,
            boundary: a.$win,
            delay: 0,
            dropdownSelector: ".uk-dropdown,.uk-dropdown-blank",
            hoverDelayIdle: 250,
            preventflip: !1
        }, remainIdle: !1, boot: function () {
            var b =
                a.support.touch ? "click" : "mouseenter";
            a.$html.on(b + ".dropdown.uikit", "[data-uk-dropdown]", function (d) {
                var e = a.$(this);
                e.data("dropdown") || (e = a.dropdown(e, a.Utils.options(e.attr("data-uk-dropdown"))), ("click" == b || "mouseenter" == b && "hover" == e.options.mode) && e.element.trigger(b), e.element.find(e.options.dropdownSelector).length && d.preventDefault())
            })
        }, init: function () {
            var d = this;
            this.dropdown = this.find(this.options.dropdownSelector);
            this.offsetParent = this.dropdown.parents().filter(function () {
                return -1 !==
                    a.$.inArray(a.$(this).css("position"), ["relative", "fixed", "absolute"])
            }).slice(0, 1);
            this.centered = this.dropdown.hasClass("uk-dropdown-center");
            this.justified = this.options.justify ? a.$(this.options.justify) : !1;
            this.boundary = a.$(this.options.boundary);
            this.boundary.length || (this.boundary = a.$win);
            this.dropdown.hasClass("uk-dropdown-up") && (this.options.pos = "top-left");
            this.dropdown.hasClass("uk-dropdown-flip") && (this.options.pos = this.options.pos.replace("left", "right"));
            this.dropdown.hasClass("uk-dropdown-center") &&
            (this.options.pos = this.options.pos.replace(/(left|right)/, "center"));
            this.element.attr("aria-haspopup", "true");
            this.element.attr("aria-expanded", this.element.hasClass("uk-open"));
            "click" == this.options.mode || a.support.touch ? this.on("click.uk.dropdown", function (b) {
                    var e = a.$(b.target);
                    e.parents(d.options.dropdownSelector).length || ((e.is("a[href='#']") || e.parent().is("a[href='#']") || d.dropdown.length && !d.dropdown.is(":visible")) && b.preventDefault(), e.blur());
                    d.element.hasClass("uk-open") ? (!d.dropdown.find(b.target).length ||
                        e.is(".uk-dropdown-close") || e.parents(".uk-dropdown-close").length) && d.hide() : d.show()
                }) : this.on("mouseenter", function () {
                    d.trigger("pointerenter.uk.dropdown", [d]);
                    d.remainIdle && clearTimeout(d.remainIdle);
                    c && clearTimeout(c);
                    b && b == d || (c = b && b != d ? setTimeout(function () {
                            c = setTimeout(d.show.bind(d), d.options.delay)
                        }, d.options.hoverDelayIdle) : setTimeout(d.show.bind(d), d.options.delay))
                }).on("mouseleave", function () {
                    c && clearTimeout(c);
                    d.remainIdle = setTimeout(function () {
                        b && b == d && d.hide()
                    }, d.options.remaintime);
                    d.trigger("pointerleave.uk.dropdown", [d])
                }).on("click", function (e) {
                    var c = a.$(e.target);
                    return d.remainIdle && clearTimeout(d.remainIdle), b && b == d ? ((!d.dropdown.find(e.target).length || c.is(".uk-dropdown-close") || c.parents(".uk-dropdown-close").length) && d.hide(), void 0) : ((c.is("a[href='#']") || c.parent().is("a[href='#']")) && e.preventDefault(), d.show(), void 0)
                })
        }, show: function () {
            a.$html.off("click.outer.dropdown");
            b && b != this && b.hide(!0);
            c && clearTimeout(c);
            this.trigger("beforeshow.uk.dropdown", [this]);
            this.checkDimensions();
            this.element.addClass("uk-open");
            this.element.attr("aria-expanded", "true");
            this.trigger("show.uk.dropdown", [this]);
            a.Utils.checkDisplay(this.dropdown, !0);
            b = this;
            this.registerOuterClick()
        }, hide: function (a) {
            this.trigger("beforehide.uk.dropdown", [this, a]);
            this.element.removeClass("uk-open");
            this.remainIdle && clearTimeout(this.remainIdle);
            this.remainIdle = !1;
            this.element.attr("aria-expanded", "false");
            this.trigger("hide.uk.dropdown", [this, a]);
            b == this && (b = !1)
        }, registerOuterClick: function () {
            var d = this;
            a.$html.off("click.outer.dropdown");
            setTimeout(function () {
                a.$html.on("click.outer.dropdown", function (e) {
                    c && clearTimeout(c);
                    a.$(e.target);
                    b != d || d.element.find(e.target).length || (d.hide(!0), a.$html.off("click.outer.dropdown"))
                })
            }, 10)
        }, checkDimensions: function () {
            if (this.dropdown.length) {
                this.dropdown.removeClass("uk-dropdown-top uk-dropdown-bottom uk-dropdown-left uk-dropdown-right uk-dropdown-stack").css({
                    "top-left": "",
                    left: "",
                    "margin-left": "",
                    "margin-right": ""
                });
                this.justified && this.justified.length && this.dropdown.css("min-width", "");
                var b, c = a.$.extend({}, this.offsetParent.offset(), {
                    width: this.offsetParent[0].offsetWidth,
                    height: this.offsetParent[0].offsetHeight
                });
                b = this.options.offset;
                var p = this.dropdown, h = (p.show().offset() || {
                    left: 0,
                    top: 0
                }, p.outerWidth()), m = p.outerHeight(), r = this.boundary.width(), n = (this.boundary[0] !== window && this.boundary.offset() ? this.boundary.offset() : {
                        top: 0,
                        left: 0
                    }, this.options.pos), t = {
                    "bottom-left": {top: 0 + c.height + b, left: 0},
                    "bottom-right": {top: 0 + c.height + b, left: 0 + c.width - h},
                    "bottom-center": {
                        top: 0 + c.height +
                        b, left: 0 + c.width / 2 - h / 2
                    },
                    "top-left": {top: 0 - m - b, left: 0},
                    "top-right": {top: 0 - m - b, left: 0 + c.width - h},
                    "top-center": {top: 0 - m - b, left: 0 + c.width / 2 - h / 2},
                    "left-top": {top: 0, left: 0 - h - b},
                    "left-bottom": {top: 0 + c.height - m, left: 0 - h - b},
                    "left-center": {top: 0 + c.height / 2 - m / 2, left: 0 - h - b},
                    "right-top": {top: 0, left: 0 + c.width + b},
                    "right-bottom": {top: 0 + c.height - m, left: 0 + c.width + b},
                    "right-center": {top: 0 + c.height / 2 - m / 2, left: 0 + c.width + b}
                }, q = {};
                if (b = n.split("-"), q = t[n] ? t[n] : t["bottom-left"], this.justified && this.justified.length) f(p.css({left: 0}),
                    this.justified, r); else if (!0 !== this.options.preventflip) {
                    var u;
                    switch (this.checkBoundary(c.left + q.left, c.top + q.top, h, m, r)) {
                        case "x":
                            "x" !== this.options.preventflip && (u = g[n] || "right-top");
                            break;
                        case "y":
                            "y" !== this.options.preventflip && (u = e[n] || "top-left");
                            break;
                        case "xy":
                            this.options.preventflip || (u = d[n] || "right-bottom")
                    }
                    u && (b = u.split("-"), q = t[u] ? t[u] : t["bottom-left"], this.checkBoundary(c.left + q.left, c.top + q.top, h, m, r) && (b = n.split("-"), q = t[n] ? t[n] : t["bottom-left"]))
                }
                h > r && (p.addClass("uk-dropdown-stack"),
                    this.trigger("stack.uk.dropdown", [this]));
                p.css(q).css("display", "").addClass("uk-dropdown-" + b[0])
            }
        }, checkBoundary: function (b, d, e, c, g) {
            var f = "";
            return (0 > b || b - a.$win.scrollLeft() + e > g) && (f += "x"), (0 > d - a.$win.scrollTop() || d - a.$win.scrollTop() + c > window.innerHeight) && (f += "y"), f
        }
    });
    a.component("dropdownOverlay", {
        defaults: {justify: !1, cls: "", duration: 200}, boot: function () {
            a.ready(function (b) {
                a.$("[data-uk-dropdown-overlay]", b).each(function () {
                    var b = a.$(this);
                    b.data("dropdownOverlay") || a.dropdownOverlay(b, a.Utils.options(b.attr("data-uk-dropdown-overlay")))
                })
            })
        },
        init: function () {
            var d = this;
            this.justified = this.options.justify ? a.$(this.options.justify) : !1;
            this.overlay = this.element.find("uk-dropdown-overlay");
            this.overlay.length || (this.overlay = a.$('<div class="uk-dropdown-overlay"></div>').appendTo(this.element));
            this.overlay.addClass(this.options.cls);
            this.on({
                "beforeshow.uk.dropdown": function (a, b) {
                    d.dropdown = b;
                    d.justified && d.justified.length && f(d.overlay.css({
                        display: "block",
                        "margin-left": "",
                        "margin-right": ""
                    }), d.justified, d.justified.outerWidth())
                }, "show.uk.dropdown": function () {
                    var b =
                        d.dropdown.dropdown.outerHeight(!0);
                    d.dropdown.element.removeClass("uk-open");
                    d.overlay.stop().css("display", "block").animate({height: b}, d.options.duration, function () {
                        d.dropdown.dropdown.css("visibility", "");
                        d.dropdown.element.addClass("uk-open");
                        a.Utils.checkDisplay(d.dropdown.dropdown, !0)
                    });
                    d.pointerleave = !1
                }, "hide.uk.dropdown": function () {
                    d.overlay.stop().animate({height: 0}, d.options.duration)
                }, "pointerenter.uk.dropdown": function () {
                    clearTimeout(d.remainIdle)
                }, "pointerleave.uk.dropdown": function () {
                    d.pointerleave = !0
                }
            });
            this.overlay.on({
                mouseenter: function () {
                    d.remainIdle && (clearTimeout(d.dropdown.remainIdle), clearTimeout(d.remainIdle))
                }, mouseleave: function () {
                    d.pointerleave && b && (d.remainIdle = setTimeout(function () {
                        b && b.hide()
                    }, b.options.remaintime))
                }
            })
        }
    })
})(UIkit);
(function (a) {
    var f = [];
    a.component("gridMatchHeight", {
        defaults: {target: !1, row: !0, ignorestacked: !1}, boot: function () {
            a.ready(function (c) {
                a.$("[data-uk-grid-match]", c).each(function () {
                    var b = a.$(this);
                    b.data("gridMatchHeight") || a.gridMatchHeight(b, a.Utils.options(b.attr("data-uk-grid-match")))
                })
            })
        }, init: function () {
            var c = this;
            this.columns = this.element.children();
            this.elements = this.options.target ? this.find(this.options.target) : this.columns;
            this.columns.length && (a.$win.on("load resize orientationchange",
                function () {
                    var b = function () {
                        c.match()
                    };
                    return a.$(function () {
                        b()
                    }), a.Utils.debounce(b, 50)
                }()), a.$html.on("changed.uk.dom", function () {
                c.columns = c.element.children();
                c.elements = c.options.target ? c.find(c.options.target) : c.columns;
                c.match()
            }), this.on("display.uk.check", function () {
                this.element.is(":visible") && this.match()
            }.bind(this)), f.push(this))
        }, match: function () {
            var c = this.columns.filter(":visible:first");
            if (c.length)return 100 <= Math.ceil(100 * parseFloat(c.css("width")) / parseFloat(c.parent().css("width"))) && !this.options.ignorestacked ? this.revert() : a.Utils.matchHeights(this.elements, this.options), this
        }, revert: function () {
            return this.elements.css("min-height", ""), this
        }
    });
    a.component("gridMargin", {
        defaults: {cls: "uk-grid-margin", rowfirst: "uk-row-first"}, boot: function () {
            a.ready(function (c) {
                a.$("[data-uk-grid-margin]", c).each(function () {
                    var b = a.$(this);
                    b.data("gridMargin") || a.gridMargin(b, a.Utils.options(b.attr("data-uk-grid-margin")))
                })
            })
        }, init: function () {
            a.stackMargin(this.element, this.options)
        }
    })
})(UIkit);
(function (a) {
    function f(b, e) {
        return e ? ("object" == typeof b ? (b = b instanceof jQuery ? b : a.$(b), b.parent().length && (e.persist = b, e.persist.data("modalPersistParent", b.parent()))) : b = "string" == typeof b || "number" == typeof b ? a.$("<div></div>").html(b) : a.$("<div></div>").html("UIkit.modal Error: Unsupported data type: " + typeof b), b.appendTo(e.element.find(".uk-modal-dialog")), e) : void 0
    }

    var c, b = !1, g = 0, e = a.$html;
    a.component("modal", {
        defaults: {keyboard: !0, bgclose: !0, minScrollHeight: 150, center: !1, modal: !0}, scrollable: !1,
        transition: !1, hasTransitioned: !0, init: function () {
            if (c || (c = a.$("body")), this.element.length) {
                var b = this;
                this.paddingdir = "padding-" + ("left" == a.langdirection ? "right" : "left");
                this.dialog = this.find(".uk-modal-dialog");
                this.active = !1;
                this.element.attr("aria-hidden", this.element.hasClass("uk-open"));
                this.on("click", ".uk-modal-close", function (a) {
                    a.preventDefault();
                    b.hide()
                }).on("click", function (e) {
                    a.$(e.target)[0] == b.element[0] && b.options.bgclose && b.hide()
                })
            }
        }, toggle: function () {
            return this[this.isActive() ?
                "hide" : "show"]()
        }, show: function () {
            if (this.element.length) {
                var d = this;
                if (!this.isActive())return this.options.modal && b && b.hide(!0), this.element.removeClass("uk-open").show(), this.resize(), this.options.modal && (b = this), this.active = !0, g++, a.support.transition ? (this.hasTransitioned = !1, this.element.one(a.support.transition.end, function () {
                        d.hasTransitioned = !0
                    }).addClass("uk-open")) : this.element.addClass("uk-open"), e.addClass("uk-modal-page").height(), this.element.attr("aria-hidden", "false"), this.element.trigger("show.uk.modal"),
                    a.Utils.checkDisplay(this.dialog, !0), this
            }
        }, hide: function (b) {
            if (!b && a.support.transition && this.hasTransitioned) {
                var e = this;
                this.one(a.support.transition.end, function () {
                    e._hide()
                }).removeClass("uk-open")
            } else this._hide();
            return this
        }, resize: function () {
            var a = c.width();
            if (this.scrollbarwidth = window.innerWidth - a, c.css(this.paddingdir, this.scrollbarwidth), this.element.css("overflow-y", this.scrollbarwidth ? "scroll" : "auto"), !this.updateScrollable() && this.options.center) {
                var a = this.dialog.outerHeight(), b =
                    parseInt(this.dialog.css("margin-top"), 10) + parseInt(this.dialog.css("margin-bottom"), 10);
                a + b < window.innerHeight ? this.dialog.css({top: window.innerHeight / 2 - a / 2 - b}) : this.dialog.css({top: ""})
            }
        }, updateScrollable: function () {
            var a = this.dialog.find(".uk-overflow-container:visible:first");
            if (a.length) {
                a.css("height", 0);
                var b = Math.abs(parseInt(this.dialog.css("margin-top"), 10)), e = this.dialog.outerHeight(), b = window.innerHeight - 2 * (20 > b ? 20 : b) - e;
                return a.css({"max-height": b < this.options.minScrollHeight ? "" : b, height: ""}),
                    !0
            }
            return !1
        }, _hide: function () {
            this.active = !1;
            0 < g ? g-- : g = 0;
            this.element.hide().removeClass("uk-open");
            this.element.attr("aria-hidden", "true");
            g || (e.removeClass("uk-modal-page"), c.css(this.paddingdir, ""));
            b === this && (b = !1);
            this.trigger("hide.uk.modal")
        }, isActive: function () {
            return this.active
        }
    });
    a.component("modalTrigger", {
        boot: function () {
            a.$html.on("click.modal.uikit", "[data-uk-modal]", function (b) {
                var e = a.$(this);
                (e.is("a") && b.preventDefault(), e.data("modalTrigger")) || a.modalTrigger(e, a.Utils.options(e.attr("data-uk-modal"))).show()
            });
            a.$html.on("keydown.modal.uikit", function (a) {
                b && 27 === a.keyCode && b.options.keyboard && (a.preventDefault(), b.hide())
            });
            a.$win.on("resize orientationchange", a.Utils.debounce(function () {
                b && b.resize()
            }, 150))
        }, init: function () {
            var b = this;
            this.options = a.$.extend({target: b.element.is("a") ? b.element.attr("href") : !1}, this.options);
            this.modal = a.modal(this.options.target, this.options);
            this.on("click", function (a) {
                a.preventDefault();
                b.show()
            });
            this.proxy(this.modal, "show hide isActive")
        }
    });
    a.modal.dialog = function (b,
                               e) {
        var c = a.modal(a.$(a.modal.dialog.template).appendTo("body"), e);
        return c.on("hide.uk.modal", function () {
            c.persist && (c.persist.appendTo(c.persist.data("modalPersistParent")), c.persist = !1);
            c.element.remove()
        }), f(b, c), c
    };
    a.modal.dialog.template = '<div class="uk-modal"><div class="uk-modal-dialog" style="min-height:0;"></div></div>';
    a.modal.alert = function (b, e) {
        e = a.$.extend(!0, {bgclose: !1, keyboard: !1, modal: !1, labels: a.modal.labels}, e);
        var c = a.modal.dialog(['<div class="uk-margin uk-modal-content">' + String(b) +
        "</div>", '<div class="uk-modal-footer uk-text-right"><button class="uk-button uk-button-primary uk-modal-close">' + e.labels.Ok + "</button></div>"].join(""), e);
        return c.on("show.uk.modal", function () {
            setTimeout(function () {
                c.element.find("button:first").focus()
            }, 50)
        }), c.show()
    };
    a.modal.confirm = function (b, e, c) {
        var g = 1 < arguments.length && arguments[arguments.length - 1] ? arguments[arguments.length - 1] : {};
        e = a.$.isFunction(e) ? e : function () {
            };
        c = a.$.isFunction(c) ? c : function () {
            };
        var g = a.$.extend(!0, {
            bgclose: !1, keyboard: !1,
            modal: !1, labels: a.modal.labels
        }, a.$.isFunction(g) ? {} : g), h = a.modal.dialog(['<div class="uk-margin uk-modal-content">' + String(b) + "</div>", '<div class="uk-modal-footer uk-text-right"><button class="uk-button js-modal-confirm-cancel">' + g.labels.Cancel + '</button> <button class="uk-button uk-button-primary js-modal-confirm">' + g.labels.Ok + "</button></div>"].join(""), g);
        return h.element.find(".js-modal-confirm, .js-modal-confirm-cancel").on("click", function () {
            a.$(this).is(".js-modal-confirm") ? e() : c();
            h.hide()
        }),
            h.on("show.uk.modal", function () {
                setTimeout(function () {
                    h.element.find(".js-modal-confirm").focus()
                }, 50)
            }), h.show()
    };
    a.modal.prompt = function (b, e, c, g) {
        c = a.$.isFunction(c) ? c : function () {
            };
        g = a.$.extend(!0, {bgclose: !1, keyboard: !1, modal: !1, labels: a.modal.labels}, g);
        var h = a.modal.dialog([b ? '<div class="uk-modal-content uk-form">' + String(b) + "</div>" : "", '<div class="uk-margin-small-top uk-modal-content uk-form"><p><input type="text" class="uk-width-1-1"></p></div>', '<div class="uk-modal-footer uk-text-right"><button class="uk-button uk-modal-close">' +
        g.labels.Cancel + '</button> <button class="uk-button uk-button-primary js-modal-ok">' + g.labels.Ok + "</button></div>"].join(""), g), f = h.element.find("input[type='text']").val(e || "").on("keyup", function (a) {
            13 == a.keyCode && h.element.find(".js-modal-ok").trigger("click")
        });
        return h.element.find(".js-modal-ok").on("click", function () {
            !1 !== c(f.val()) && h.hide()
        }), h.on("show.uk.modal", function () {
            setTimeout(function () {
                f.focus()
            }, 50)
        }), h.show()
    };
    a.modal.blockUI = function (b, e) {
        var c = a.modal.dialog("" + ('<div class="uk-margin uk-modal-content">' +
            String(b || '<div class="uk-text-center">...</div>') + "</div>"), a.$.extend({
            bgclose: !1,
            keyboard: !1,
            modal: !1
        }, e));
        return c.content = c.element.find(".uk-modal-content:first"), c.show()
    };
    a.modal.labels = {Ok: "Ok", Cancel: "Cancel"}
})(UIkit);
(function (a) {
    function f(c) {
        c = a.$(c);
        var b = "auto";
        if (c.is(":visible")) b = c.outerHeight(); else {
            var g = {
                position: c.css("position"),
                visibility: c.css("visibility"),
                display: c.css("display")
            }, b = c.css({position: "absolute", visibility: "hidden", display: "block"}).outerHeight();
            c.css(g)
        }
        return b
    }

    a.component("nav", {
        defaults: {toggle: ">li.uk-parent > a[href='#']", lists: ">li.uk-parent > ul", multiple: !1},
        boot: function () {
            a.ready(function (c) {
                a.$("[data-uk-nav]", c).each(function () {
                    var b = a.$(this);
                    b.data("nav") || a.nav(b,
                        a.Utils.options(b.attr("data-uk-nav")))
                })
            })
        },
        init: function () {
            var c = this;
            this.on("click.uk.nav", this.options.toggle, function (b) {
                b.preventDefault();
                b = a.$(this);
                c.open(b.parent()[0] == c.element[0] ? b : b.parent("li"))
            });
            this.find(this.options.lists).each(function () {
                var b = a.$(this), g = b.parent(), e = g.hasClass("uk-active");
                b.wrap('<div style="overflow:hidden;height:0;position:relative;"></div>');
                g.data("list-container", b.parent()[e ? "removeClass" : "addClass"]("uk-hidden"));
                g.attr("aria-expanded", g.hasClass("uk-open"));
                e && c.open(g, !0)
            })
        },
        open: function (c, b) {
            var g = this, e = this.element, d = a.$(c), k = d.data("list-container");
            this.options.multiple || e.children(".uk-open").not(c).each(function () {
                var b = a.$(this);
                b.data("list-container") && b.data("list-container").stop().animate({height: 0}, function () {
                    a.$(this).parent().removeClass("uk-open").end().addClass("uk-hidden")
                })
            });
            d.toggleClass("uk-open");
            d.attr("aria-expanded", d.hasClass("uk-open"));
            k && (d.hasClass("uk-open") && k.removeClass("uk-hidden"), b ? (k.stop().height(d.hasClass("uk-open") ?
                    "auto" : 0), d.hasClass("uk-open") || k.addClass("uk-hidden"), this.trigger("display.uk.check")) : k.stop().animate({height: d.hasClass("uk-open") ? f(k.find("ul:first")) : 0}, function () {
                    d.hasClass("uk-open") ? k.css("height", "") : k.addClass("uk-hidden");
                    g.trigger("display.uk.check")
                }))
        }
    })
})(UIkit);
(function (a) {
    var f = window.scrollX, c = window.scrollY, b = (a.$win, a.$doc, a.$html), g = {
        show: function (e) {
            if (e = a.$(e), e.length) {
                var d = a.$("body"), g = e.find(".uk-offcanvas-bar:first"), l = "right" == a.langdirection, p = (g.hasClass("uk-offcanvas-bar-flip") ? -1 : 1) * (l ? -1 : 1), h = window.innerWidth - d.width();
                f = window.pageXOffset;
                c = window.pageYOffset;
                e.addClass("uk-active");
                d.css({width: window.innerWidth - h, height: window.innerHeight}).addClass("uk-offcanvas-page");
                d.css(l ? "margin-right" : "margin-left", (l ? -1 : 1) * g.outerWidth() *
                    p).width();
                b.css("margin-top", -1 * c);
                g.addClass("uk-offcanvas-bar-show");
                this._initElement(e);
                g.trigger("show.uk.offcanvas", [e, g]);
                e.attr("aria-hidden", "false")
            }
        }, hide: function (e) {
            var d = a.$("body"), g = a.$(".uk-offcanvas.uk-active"), l = "right" == a.langdirection, p = g.find(".uk-offcanvas-bar:first"), h = function () {
                d.removeClass("uk-offcanvas-page").css({width: "", height: "", "margin-left": "", "margin-right": ""});
                g.removeClass("uk-active");
                p.removeClass("uk-offcanvas-bar-show");
                b.css("margin-top", "");
                window.scrollTo(f,
                    c);
                p.trigger("hide.uk.offcanvas", [g, p]);
                g.attr("aria-hidden", "true")
            };
            g.length && (a.support.transition && !e ? (d.one(a.support.transition.end, function () {
                    h()
                }).css(l ? "margin-right" : "margin-left", ""), setTimeout(function () {
                    p.removeClass("uk-offcanvas-bar-show")
                }, 0)) : h())
        }, _initElement: function (b) {
            b.data("OffcanvasInit") || (b.on("click.uk.offcanvas swipeRight.uk.offcanvas swipeLeft.uk.offcanvas", function (b) {
                var e = a.$(b.target);
                if (b.type.match(/swipe/) || e.hasClass("uk-offcanvas-close") || !e.hasClass("uk-offcanvas-bar") && !e.parents(".uk-offcanvas-bar:first").length) b.stopImmediatePropagation(), g.hide()
            }), b.on("click", "a[href*='#']", function () {
                var b = a.$(this), e = b.attr("href");
                "#" != e && (a.$doc.one("hide.uk.offcanvas", function () {
                    var c;
                    try {
                        c = a.$(b[0].hash)
                    } catch (g) {
                        c = ""
                    }
                    c.length || (c = a.$('[name="' + b[0].hash.replace("#", "") + '"]'));
                    c.length && a.Utils.scrollToElement ? a.Utils.scrollToElement(c, a.Utils.options(b.attr("data-uk-smooth-scroll") || "{}")) : window.location.href = e
                }), g.hide())
            }), b.data("OffcanvasInit", !0))
        }
    };
    a.component("offcanvasTrigger",
        {
            boot: function () {
                b.on("click.offcanvas.uikit", "[data-uk-offcanvas]", function (b) {
                    b.preventDefault();
                    b = a.$(this);
                    b.data("offcanvasTrigger") || (a.offcanvasTrigger(b, a.Utils.options(b.attr("data-uk-offcanvas"))), b.trigger("click"))
                });
                b.on("keydown.uk.offcanvas", function (a) {
                    27 === a.keyCode && g.hide()
                })
            }, init: function () {
            var b = this;
            this.options = a.$.extend({target: b.element.is("a") ? b.element.attr("href") : !1}, this.options);
            this.on("click", function (a) {
                a.preventDefault();
                g.show(b.options.target)
            })
        }
        });
    a.offcanvas =
        g
})(UIkit);
(function (a) {
    function f(b, c, e) {
        var d, f = a.$.Deferred(), l = b, p = b;
        return e[0] === c[0] ? (f.resolve(), f.promise()) : ("object" == typeof b && (l = b[0], p = b[1] || b[0]), a.$body.css("overflow-x", "hidden"), d = function () {
                c && c.hide().removeClass("uk-active " + p + " uk-animation-reverse");
                e.addClass(l).one(a.support.animation.end, function () {
                    e.removeClass("" + l).css({opacity: "", display: ""});
                    f.resolve();
                    a.$body.css("overflow-x", "");
                    c && c.css({opacity: "", display: ""})
                }.bind(this)).show()
            }, e.css("animation-duration", this.options.duration + "ms"),
                c && c.length ? (c.css("animation-duration", this.options.duration + "ms"), c.css("display", "none").addClass(p + " uk-animation-reverse").one(a.support.animation.end, function () {
                        d()
                    }.bind(this)).css("display", "")) : (e.addClass("uk-active"), d()), f.promise())
    }

    var c;
    a.component("switcher", {
        defaults: {connect: !1, toggle: ">*", active: 0, animation: !1, duration: 200, swiping: !0},
        animating: !1,
        boot: function () {
            a.ready(function (b) {
                a.$("[data-uk-switcher]", b).each(function () {
                    var b = a.$(this);
                    b.data("switcher") || a.switcher(b, a.Utils.options(b.attr("data-uk-switcher")))
                })
            })
        },
        init: function () {
            var b = this;
            if (this.on("click.uk.switcher", this.options.toggle, function (a) {
                    a.preventDefault();
                    b.show(this)
                }), this.options.connect) {
                this.connect = a.$(this.options.connect);
                this.connect.find(".uk-active").removeClass(".uk-active");
                this.connect.length && (this.connect.children().attr("aria-hidden", "true"), this.connect.on("click", "[data-uk-switcher-item]", function (d) {
                    d.preventDefault();
                    d = a.$(this).attr("data-uk-switcher-item");
                    if (b.index != d)switch (d) {
                        case "next":
                        case "previous":
                            b.show(b.index +
                                ("next" == d ? 1 : -1));
                            break;
                        default:
                            b.show(parseInt(d, 10))
                    }
                }), this.options.swiping && this.connect.on("swipeRight swipeLeft", function (a) {
                    a.preventDefault();
                    window.getSelection().toString() || b.show(b.index + ("swipeLeft" == a.type ? 1 : -1))
                }));
                var c = this.find(this.options.toggle), e = c.filter(".uk-active");
                if (e.length) this.show(e, !1); else {
                    if (!1 === this.options.active)return;
                    e = c.eq(this.options.active);
                    this.show(e.length ? e : c.eq(0), !1)
                }
                c.not(e).attr("aria-expanded", "false");
                e.attr("aria-expanded", "true");
                this.on("changed.uk.dom",
                    function () {
                        b.connect = a.$(b.options.connect)
                    })
            }
        },
        show: function (b, g) {
            if (!this.animating) {
                if (isNaN(b)) b = a.$(b); else {
                    var e = this.find(this.options.toggle);
                    b = 0 > b ? e.length - 1 : b;
                    b = e.eq(e[b] ? b : 0)
                }
                var d = this, e = this.find(this.options.toggle), k = a.$(b), l = c[this.options.animation] || function (a, b) {
                        if (!d.options.animation)return c.none.apply(d);
                        var e = d.options.animation.split(",");
                        return 1 == e.length && (e[1] = e[0]), e[0] = e[0].trim(), e[1] = e[1].trim(), f.apply(d, [e, a, b])
                    };
                !1 !== g && a.support.animation || (l = c.none);
                k.hasClass("uk-disabled") ||
                (e.attr("aria-expanded", "false"), k.attr("aria-expanded", "true"), e.filter(".uk-active").removeClass("uk-active"), k.addClass("uk-active"), this.options.connect && this.connect.length && (this.index = this.find(this.options.toggle).index(k), -1 == this.index && (this.index = 0), this.connect.each(function () {
                    var b = a.$(this), b = a.$(b.children()), e = a.$(b.filter(".uk-active")), c = a.$(b.eq(d.index));
                    d.animating = !0;
                    l.apply(d, [e, c]).then(function () {
                        e.removeClass("uk-active");
                        c.addClass("uk-active");
                        e.attr("aria-hidden", "true");
                        c.attr("aria-hidden", "false");
                        a.Utils.checkDisplay(c, !0);
                        d.animating = !1
                    })
                })), this.trigger("show.uk.switcher", [k]))
            }
        }
    });
    c = {
        none: function () {
            var b = a.$.Deferred();
            return b.resolve(), b.promise()
        }, fade: function (a, c) {
            return f.apply(this, ["uk-animation-fade", a, c])
        }, "slide-bottom": function (a, c) {
            return f.apply(this, ["uk-animation-slide-bottom", a, c])
        }, "slide-top": function (a, c) {
            return f.apply(this, ["uk-animation-slide-top", a, c])
        }, "slide-vertical": function (a, c) {
            var e = ["uk-animation-slide-top", "uk-animation-slide-bottom"];
            return a && a.index() > c.index() && e.reverse(), f.apply(this, [e, a, c])
        }, "slide-left": function (a, c) {
            return f.apply(this, ["uk-animation-slide-left", a, c])
        }, "slide-right": function (a, c) {
            return f.apply(this, ["uk-animation-slide-right", a, c])
        }, "slide-horizontal": function (a, c) {
            var e = ["uk-animation-slide-right", "uk-animation-slide-left"];
            return a && a.index() > c.index() && e.reverse(), f.apply(this, [e, a, c])
        }, scale: function (a, c) {
            return f.apply(this, ["uk-animation-scale-up", a, c])
        }
    };
    a.switcher.animations = c
})(UIkit);
(function (a) {
    a.component("tab", {
        defaults: {
            target: ">li:not(.uk-tab-responsive, .uk-disabled)",
            connect: !1,
            active: 0,
            animation: !1,
            duration: 200,
            swiping: !0
        }, boot: function () {
            a.ready(function (f) {
                a.$("[data-uk-tab]", f).each(function () {
                    var c = a.$(this);
                    c.data("tab") || a.tab(c, a.Utils.options(c.attr("data-uk-tab")))
                })
            })
        }, init: function () {
            var f = this;
            this.current = !1;
            this.on("click.uk.tab", this.options.target, function (c) {
                (c.preventDefault(), f.switcher && f.switcher.animating) || (c = f.find(f.options.target).not(this),
                    c.removeClass("uk-active").blur(), f.trigger("change.uk.tab", [a.$(this).addClass("uk-active"), f.current]), f.current = a.$(this), f.options.connect || (c.attr("aria-expanded", "false"), a.$(this).attr("aria-expanded", "true")))
            });
            this.options.connect && (this.connect = a.$(this.options.connect));
            this.responsivetab = a.$('<li class="uk-tab-responsive uk-active"><a></a></li>').append('<div class="uk-dropdown uk-dropdown-small"><ul class="uk-nav uk-nav-dropdown"></ul><div>');
            this.responsivetab.dropdown = this.responsivetab.find(".uk-dropdown");
            this.responsivetab.lst = this.responsivetab.dropdown.find("ul");
            this.responsivetab.caption = this.responsivetab.find("a:first");
            this.element.hasClass("uk-tab-bottom") && this.responsivetab.dropdown.addClass("uk-dropdown-up");
            this.responsivetab.lst.on("click.uk.tab", "a", function (c) {
                c.preventDefault();
                c.stopPropagation();
                c = a.$(this);
                f.element.children("li:not(.uk-tab-responsive)").eq(c.data("index")).trigger("click")
            });
            this.on("show.uk.switcher change.uk.tab", function (a, b) {
                f.responsivetab.caption.html(b.text())
            });
            this.element.append(this.responsivetab);
            this.options.connect && (this.switcher = a.switcher(this.element, {
                toggle: ">li:not(.uk-tab-responsive)",
                connect: this.options.connect,
                active: this.options.active,
                animation: this.options.animation,
                duration: this.options.duration,
                swiping: this.options.swiping
            }));
            a.dropdown(this.responsivetab, {mode: "click", preventflip: "y"});
            f.trigger("change.uk.tab", [this.element.find(this.options.target).not(".uk-tab-responsive").filter(".uk-active")]);
            this.check();
            a.$win.on("resize orientationchange",
                a.Utils.debounce(function () {
                    f.element.is(":visible") && f.check()
                }, 100));
            this.on("display.uk.check", function () {
                f.element.is(":visible") && f.check()
            })
        }, check: function () {
            var f = this.element.children("li:not(.uk-tab-responsive)").removeClass("uk-hidden");
            if (!f.length)return this.responsivetab.addClass("uk-hidden"), void 0;
            var c, b, g = f.eq(0).offset().top + Math.ceil(f.eq(0).height() / 2), e = !1;
            if (this.responsivetab.lst.empty(), f.each(function () {
                    a.$(this).offset().top > g && (e = !0)
                }), e)for (var d = 0; d < f.length; d++)c = a.$(f.eq(d)),
                c.find("a"), "none" == c.css("float") || c.attr("uk-dropdown") || (c.hasClass("uk-disabled") || (b = c[0].outerHTML.replace("<a ", '<a data-index="' + d + '" '), this.responsivetab.lst.append(b)), c.addClass("uk-hidden"));
            this.responsivetab[this.responsivetab.lst.children("li").length ? "removeClass" : "addClass"]("uk-hidden")
        }
    })
})(UIkit);
(function (a) {
    a.component("cover", {
        defaults: {automute: !0}, boot: function () {
            a.ready(function (f) {
                a.$("[data-uk-cover]", f).each(function () {
                    var c = a.$(this);
                    c.data("cover") || a.cover(c, a.Utils.options(c.attr("data-uk-cover")))
                })
            })
        }, init: function () {
            if (this.parent = this.element.parent(), a.$win.on("load resize orientationchange", a.Utils.debounce(function () {
                    this.check()
                }.bind(this), 100)), this.on("display.uk.check", function () {
                    this.element.is(":visible") && this.check()
                }.bind(this)), this.check(), this.element.is("iframe") &&
                this.options.automute) {
                var f = this.element.attr("src");
                this.element.attr("src", "").on("load", function () {
                    this.contentWindow.postMessage('{ "event": "command", "func": "mute", "method":"setVolume", "value":0}', "*")
                }).attr("src", [f, -1 < f.indexOf("?") ? "&" : "?", "enablejsapi=1&api=1"].join(""))
            }
        }, check: function () {
            this.element.css({width: "", height: ""});
            this.dimension = {w: this.element.width(), h: this.element.height()};
            this.element.attr("width") && !isNaN(this.element.attr("width")) && (this.dimension.w = this.element.attr("width"));
            this.element.attr("height") && !isNaN(this.element.attr("height")) && (this.dimension.h = this.element.attr("height"));
            this.ratio = this.dimension.w / this.dimension.h;
            var a, c, b = this.parent.width(), g = this.parent.height();
            b / this.ratio < g ? (a = Math.ceil(g * this.ratio), c = g) : (a = b, c = Math.ceil(b / this.ratio));
            this.element.css({width: a, height: c})
        }
    })
})(UIkit);
!function (a) {
    var f;
    window.UIkit && (f = a(UIkit));
    "function" == typeof define && define.amd && define("uikit-parallax", ["uikit"], function () {
        return f || a(UIkit)
    })
}(function (a) {
    function f(b, d, c) {
        var e, g, f, k, l, v, w, x = new Image;
        return g = b.element.css({
            "background-size": "cover",
            "background-repeat": "no-repeat"
        }), e = g.css("background-image").replace(/^url\(/g, "").replace(/\)$/g, "").replace(/("|')/g, ""), k = function () {
            var a = g.innerWidth(), e = g.innerHeight(), k = "bg" == d ? c.diff : c.diff / 100 * e;
            return e += k, a += Math.ceil(k * l), a - k <
            f.w && e < f.h ? b.element.css({"background-size": "auto"}) : (e > a / l ? (v = Math.ceil(e * l), w = e, e > window.innerHeight && (v *= 1.2, w *= 1.2)) : (v = a, w = Math.ceil(a / l)), g.css({"background-size": v + "px " + w + "px"}).data("bgsize", {
                    w: v,
                    h: w
                }), void 0)
        }, x.onerror = function () {
        }, x.onload = function () {
            f = {w: x.width, h: x.height};
            l = x.width / x.height;
            a.$win.on("load resize orientationchange", a.Utils.debounce(function () {
                k()
            }, 50));
            k()
        }, x.src = e, !0
    }

    function c(a) {
        var b;
        return (b = /#([0-9a-fA-F]{2})([0-9a-fA-F]{2})([0-9a-fA-F]{2})/.exec(a)) ? [parseInt(b[1],
                16), parseInt(b[2], 16), parseInt(b[3], 16), 1] : (b = /#([0-9a-fA-F])([0-9a-fA-F])([0-9a-fA-F])/.exec(a)) ? [17 * parseInt(b[1], 16), 17 * parseInt(b[2], 16), 17 * parseInt(b[3], 16), 1] : (b = /rgb\(\s*([0-9]{1,3})\s*,\s*([0-9]{1,3})\s*,\s*([0-9]{1,3})\s*\)/.exec(a)) ? [parseInt(b[1]), parseInt(b[2]), parseInt(b[3]), 1] : (b = /rgba\(\s*([0-9]{1,3})\s*,\s*([0-9]{1,3})\s*,\s*([0-9]{1,3})\s*,\s*([0-9\.]*)\s*\)/.exec(a)) ? [parseInt(b[1], 10), parseInt(b[2], 10), parseInt(b[3], 10), parseFloat(b[4])] : l[a] || [255, 255, 255, 0]
    }

    var b = [], g = !1, e = 0,
        d = window.innerHeight, k = function () {
            e = a.$win.scrollTop();
            window.requestAnimationFrame(function () {
                for (var a = 0; a < b.length; a++)b[a].process()
            })
        };
    a.component("parallax", {
        defaults: {velocity: .5, target: !1, viewport: !1, media: !1}, boot: function () {
            g = function () {
                var a, b = document.createElement("div"), d = {
                    WebkitTransform: "-webkit-transform",
                    MSTransform: "-ms-transform",
                    MozTransform: "-moz-transform",
                    Transform: "transform"
                };
                document.body.insertBefore(b, null);
                for (var c in d)void 0 !== b.style[c] && (b.style[c] = "translate3d(1px,1px,1px)",
                    a = window.getComputedStyle(b).getPropertyValue(d[c]));
                return document.body.removeChild(b), void 0 !== a && 0 < a.length && "none" !== a
            }();
            a.$doc.on("scrolling.uk.document", k);
            a.$win.on("load resize orientationchange", a.Utils.debounce(function () {
                d = window.innerHeight;
                k()
            }, 50));
            a.ready(function (b) {
                a.$("[data-uk-parallax]", b).each(function () {
                    var b = a.$(this);
                    b.data("parallax") || a.parallax(b, a.Utils.options(b.attr("data-uk-parallax")))
                })
            })
        }, init: function () {
            this.base = this.options.target ? a.$(this.options.target) : this.element;
            this.props = {};
            this.velocity = this.options.velocity || 1;
            var d = ["target", "velocity", "viewport", "plugins", "media"];
            Object.keys(this.options).forEach(function (a) {
                if (-1 === d.indexOf(a)) {
                    var b, c, e, g, f = String(this.options[a]).split(",");
                    a.match(/color/i) ? (b = f[1] ? f[0] : this._getStartValue(a), c = f[1] ? f[1] : f[0], b || (b = "rgba(255,255,255,0)")) : (b = parseFloat(f[1] ? f[0] : this._getStartValue(a)), c = parseFloat(f[1] ? f[1] : f[0]), g = c > b ? c - b : b - c, e = c > b ? 1 : -1);
                    this.props[a] = {start: b, end: c, dir: e, diff: g}
                }
            }.bind(this));
            b.push(this)
        },
        process: function () {
            if (this.options.media)switch (typeof this.options.media) {
                case "number":
                    if (window.innerWidth < this.options.media)return !1;
                    break;
                case "string":
                    if (window.matchMedia && !window.matchMedia(this.options.media).matches)return !1
            }
            var a = this.percentageInViewport();
            !1 !== this.options.viewport && (a = 0 === this.options.viewport ? 1 : a / this.options.viewport);
            this.update(a)
        }, percentageInViewport: function () {
            var a, b, c, g = this.base.offset().top, f = this.base.outerHeight();
            return g > e + d ? c = 0 : e > g + f ? c = 1 : d > g + f ? c = (d >
                            e ? e : e - d) / (g + f) : (a = e + d - g, b = Math.round(a / ((d + f) / 100)), c = b / 100), c
        }, update: function (a) {
            var b, d, e = {transform: ""}, k = a * (1 - (this.velocity - this.velocity * a));
            0 > k && (k = 0);
            1 < k && (k = 1);
            (void 0 === this._percent || this._percent != k) && (Object.keys(this.props).forEach(function (l) {
                switch (b = this.props[l], 0 === a ? d = b.start : 1 === a ? d = b.end : void 0 !== b.diff && (d = b.start + b.diff * k * b.dir), "bg" != l && "bgp" != l || this._bgcover || (this._bgcover = f(this, l, b)), l) {
                    case "x":
                        e.transform += g ? " translate3d(" + d + "px, 0, 0)" : " translateX(" + d + "px)";
                        break;
                    case "xp":
                        e.transform += g ? " translate3d(" + d + "%, 0, 0)" : " translateX(" + d + "%)";
                        break;
                    case "y":
                        e.transform += g ? " translate3d(0, " + d + "px, 0)" : " translateY(" + d + "px)";
                        break;
                    case "yp":
                        e.transform += g ? " translate3d(0, " + d + "%, 0)" : " translateY(" + d + "%)";
                        break;
                    case "rotate":
                        e.transform += " rotate(" + d + "deg)";
                        break;
                    case "scale":
                        e.transform += " scale(" + d + ")";
                        break;
                    case "bg":
                        e["background-position"] = "50% " + d + "px";
                        break;
                    case "bgp":
                        e["background-position"] = "50% " + d + "%";
                        break;
                    case "color":
                    case "background-color":
                    case "border-color":
                        var q =
                            b.start, u = b.end, v = k, q = c(q), u = c(u), v = v || 0, v = "rgba(" + parseInt(q[0] + v * (u[0] - q[0]), 10) + "," + parseInt(q[1] + v * (u[1] - q[1]), 10) + "," + parseInt(q[2] + v * (u[2] - q[2]), 10) + "," + (q && u ? parseFloat(q[3] + v * (u[3] - q[3])) : 1) + ")";
                        e[l] = v;
                        break;
                    default:
                        e[l] = d
                }
            }.bind(this)), this.element.css(e), this._percent = k)
        }, _getStartValue: function (a) {
            var b = 0;
            switch (a) {
                case "scale":
                    b = 1;
                    break;
                default:
                    b = this.element.css(a)
            }
            return b || 0
        }
    });
    var l = {
        black: [0, 0, 0, 1],
        blue: [0, 0, 255, 1],
        brown: [165, 42, 42, 1],
        cyan: [0, 255, 255, 1],
        fuchsia: [255, 0, 255, 1],
        gold: [255,
            215, 0, 1],
        green: [0, 128, 0, 1],
        indigo: [75, 0, 130, 1],
        khaki: [240, 230, 140, 1],
        lime: [0, 255, 0, 1],
        magenta: [255, 0, 255, 1],
        maroon: [128, 0, 0, 1],
        navy: [0, 0, 128, 1],
        olive: [128, 128, 0, 1],
        orange: [255, 165, 0, 1],
        pink: [255, 192, 203, 1],
        purple: [128, 0, 128, 1],
        violet: [128, 0, 128, 1],
        red: [255, 0, 0, 1],
        silver: [192, 192, 192, 1],
        white: [255, 255, 255, 1],
        yellow: [255, 255, 0, 1],
        transparent: [255, 255, 255, 0]
    };
    return a.parallax
});
!function (a) {
    var f;
    window.UIkit && (f = a(UIkit));
    "function" == typeof define && define.amd && define("uikit-sticky", ["uikit"], function () {
        return f || a(UIkit)
    })
}(function (a) {
    function f() {
        var d = arguments.length ? arguments : g;
        if (d.length && !(0 > c.scrollTop()))for (var e, f, p, h, m = c.scrollTop(), r = b.height(), n = c.height(), n = r - n, n = m > n ? n - m : 0, t = 0; t < d.length; t++)if (h = d[t], h.element.is(":visible") && !h.animate) {
            if (h.check()) {
                if (0 > h.top ? e = 0 : (p = h.element.outerHeight(), e = r - p - h.top - h.options.bottom - m - n, e = 0 > e ? e + h.top : h.top), h.boundary &&
                    h.boundary.length) f = h.boundary.offset().top, f = h.boundtoparent ? r - (f + h.boundary.outerHeight()) + parseInt(h.boundary.css("padding-bottom")) : r - f - parseInt(h.boundary.css("margin-top")), e = m + p > r - f - (0 > h.top ? 0 : h.top) ? r - f - (m + p) : e;
                if (h.currentTop != e) {
                    if (h.element.css({
                            position: "fixed",
                            top: e,
                            width: h.getWidthFrom.length ? h.getWidthFrom.width() : h.element.width()
                        }), !h.init && (h.element.addClass(h.options.clsinit), location.hash && 0 < m && h.options.target)) f = a.$(location.hash), f.length && setTimeout(function (a, b) {
                        return function () {
                            b.element.width();
                            var d = a.offset(), e = d.top + a.outerHeight(), c = b.element.offset(), f = b.element.outerHeight(), g = c.top + f;
                            c.top < e && d.top < g && (m = d.top - f - b.options.target, window.scrollTo(0, m))
                        }
                    }(f, h), 0);
                    h.element.addClass(h.options.clsactive).removeClass(h.options.clsinactive);
                    h.element.trigger("active.uk.sticky");
                    h.element.css("margin", "");
                    h.options.animation && h.init && !a.Utils.isInView(h.wrapper) && h.element.addClass(h.options.animation);
                    h.currentTop = e
                }
            } else null !== h.currentTop && h.reset();
            h.init = !0
        }
    }

    var c = a.$win, b = a.$doc, g =
        [], e = 1;
    return a.component("sticky", {
        defaults: {
            top: 0,
            bottom: 0,
            animation: "",
            clsinit: "uk-sticky-init",
            clsactive: "uk-active",
            clsinactive: "",
            getWidthFrom: "",
            showup: !1,
            boundary: !1,
            media: !1,
            target: !1,
            disabled: !1
        }, boot: function () {
            a.$doc.on("scrolling.uk.document", function (a, b) {
                b && b.dir && (e = b.dir.y, f())
            });
            a.$win.on("resize orientationchange", a.Utils.debounce(function () {
                if (g.length) {
                    for (var a = 0; a < g.length; a++)g[a].reset(!0);
                    f()
                }
            }, 100));
            a.ready(function (b) {
                setTimeout(function () {
                    a.$("[data-uk-sticky]", b).each(function () {
                        var b =
                            a.$(this);
                        b.data("sticky") || a.sticky(b, a.Utils.options(b.attr("data-uk-sticky")))
                    });
                    f()
                }, 0)
            })
        }, init: function () {
            var d, f = this.options.boundary;
            this.wrapper = this.element.wrap('<div class="uk-sticky-placeholder"></div>').parent();
            this.computeWrapper();
            this.element.css("margin", 0);
            f && (!0 === f || "!" === f[0] ? (f = !0 === f ? this.wrapper.parent() : this.wrapper.closest(f.substr(1)), d = !0) : "string" == typeof f && (f = a.$(f)));
            this.sticky = {
                self: this,
                options: this.options,
                element: this.element,
                currentTop: null,
                wrapper: this.wrapper,
                init: !1,
                getWidthFrom: a.$(this.options.getWidthFrom || this.wrapper),
                boundary: f,
                boundtoparent: d,
                top: 0,
                calcTop: function () {
                    var b = this.options.top;
                    if (this.options.top && "string" == typeof this.options.top)if (this.options.top.match(/^(-|)(\d+)vh$/)) b = window.innerHeight * parseInt(this.options.top, 10) / 100; else {
                        var d = a.$(this.options.top).first();
                        d.length && d.is(":visible") && (b = -1 * (d.offset().top + d.outerHeight() - this.wrapper.offset().top))
                    }
                    this.top = b
                },
                reset: function (b) {
                    this.calcTop();
                    var d = function () {
                        this.element.css({
                            position: "",
                            top: "", width: "", left: "", margin: "0"
                        });
                        this.element.removeClass([this.options.animation, "uk-animation-reverse", this.options.clsactive].join(" "));
                        this.element.addClass(this.options.clsinactive);
                        this.element.trigger("inactive.uk.sticky");
                        this.currentTop = null;
                        this.animate = !1
                    }.bind(this);
                    !b && this.options.animation && a.support.animation && !a.Utils.isInView(this.wrapper) ? (this.animate = !0, this.element.removeClass(this.options.animation).one(a.support.animation.end, function () {
                            d()
                        }).width(), this.element.addClass(this.options.animation +
                            " uk-animation-reverse")) : d()
                },
                check: function () {
                    if (this.options.disabled)return !1;
                    if (this.options.media)switch (typeof this.options.media) {
                        case "number":
                            if (window.innerWidth < this.options.media)return !1;
                            break;
                        case "string":
                            if (window.matchMedia && !window.matchMedia(this.options.media).matches)return !1
                    }
                    var d = c.scrollTop(), f = b.height() - window.innerHeight, f = d > f ? f - d : 0, f = this.wrapper.offset().top - this.top - f, d = d >= f;
                    return d && this.options.showup && (1 == e && (d = !1), -1 == e && !this.element.hasClass(this.options.clsactive) &&
                    a.Utils.isInView(this.wrapper) && (d = !1)), d
                }
            };
            this.sticky.calcTop();
            g.push(this.sticky)
        }, update: function () {
            f(this.sticky)
        }, enable: function () {
            this.options.disabled = !1;
            this.update()
        }, disable: function (a) {
            this.options.disabled = !0;
            this.sticky.reset(a)
        }, computeWrapper: function () {
            this.wrapper.css({
                height: -1 == ["absolute", "fixed"].indexOf(this.element.css("position")) ? this.element.outerHeight() : "",
                "float": "none" != this.element.css("float") ? this.element.css("float") : "",
                margin: this.element.css("margin")
            });
            "fixed" ==
            this.element.css("position") && this.element.css({width: this.sticky.getWidthFrom.length ? this.sticky.getWidthFrom.width() : this.element.width()})
        }
    }), a.sticky
});
!function (a) {
    var f;
    window.UIkit && (f = a(UIkit));
    "function" == typeof define && define.amd && define("uikit-tooltip", ["uikit"], function () {
        return f || a(UIkit)
    })
}(function (a) {
    var f, c, b;
    return a.component("tooltip", {
        defaults: {
            offset: 5,
            pos: "top",
            animation: !1,
            delay: 0,
            cls: "",
            activeClass: "uk-active",
            src: function (a) {
                var b = a.attr("title");
                return void 0 !== b && a.data("cached-title", b).removeAttr("title"), a.data("cached-title")
            }
        }, tip: "", boot: function () {
            a.$html.on("mouseenter.tooltip.uikit focus.tooltip.uikit", "[data-uk-tooltip]",
                function () {
                    var b = a.$(this);
                    b.data("tooltip") || (a.tooltip(b, a.Utils.options(b.attr("data-uk-tooltip"))), b.trigger("mouseenter"))
                })
        }, init: function () {
            var b = this;
            f || (f = a.$('<div class="uk-tooltip"></div>').appendTo("body"));
            this.on({
                focus: function () {
                    b.show()
                }, blur: function () {
                    b.hide()
                }, mouseenter: function () {
                    b.show()
                }, mouseleave: function () {
                    b.hide()
                }
            })
        }, show: function () {
            if (this.tip = "function" == typeof this.options.src ? this.options.src(this.element) : this.options.src, c && clearTimeout(c), b && clearTimeout(b), "string" == typeof this.tip ? this.tip.length : 0) {
                f.stop().css({top: -2E3, visibility: "hidden"}).removeClass(this.options.activeClass).show();
                f.html('<div class="uk-tooltip-inner">' + this.tip + "</div>");
                var g = this, e = a.$.extend({}, this.element.offset(), {
                    width: this.element[0].offsetWidth,
                    height: this.element[0].offsetHeight
                }), d = f[0].offsetWidth, k = f[0].offsetHeight, l = "function" == typeof this.options.offset ? this.options.offset.call(this.element) : this.options.offset, p = "function" == typeof this.options.pos ? this.options.pos.call(this.element) :
                    this.options.pos, h = p.split("-"), m = {
                    display: "none",
                    visibility: "visible",
                    top: e.top + e.height + k,
                    left: e.left
                };
                if ("fixed" == a.$html.css("position") || "fixed" == a.$body.css("position")) {
                    var r = a.$("body").offset(), n = a.$("html").offset(), t = n.top + r.top;
                    e.left -= n.left + r.left;
                    e.top -= t
                }
                "left" != h[0] && "right" != h[0] || "right" != a.langdirection || (h[0] = "left" == h[0] ? "right" : "left");
                l = {
                    bottom: {top: e.top + e.height + l, left: e.left + e.width / 2 - d / 2},
                    top: {top: e.top - k - l, left: e.left + e.width / 2 - d / 2},
                    left: {
                        top: e.top + e.height / 2 - k / 2, left: e.left -
                        d - l
                    },
                    right: {top: e.top + e.height / 2 - k / 2, left: e.left + e.width + l}
                };
                a.$.extend(m, l[h[0]]);
                2 == h.length && (m.left = "left" == h[1] ? e.left : e.left + e.width - d);
                if (k = this.checkBoundary(m.left, m.top, d, k)) {
                    switch (k) {
                        case "x":
                            p = 2 == h.length ? h[0] + "-" + (0 > m.left ? "left" : "right") : 0 > m.left ? "right" : "left";
                            break;
                        case "y":
                            p = 2 == h.length ? (0 > m.top ? "bottom" : "top") + "-" + h[1] : 0 > m.top ? "bottom" : "top";
                            break;
                        case "xy":
                            p = 2 == h.length ? (0 > m.top ? "bottom" : "top") + "-" + (0 > m.left ? "left" : "right") : 0 > m.left ? "right" : "left"
                    }
                    h = p.split("-");
                    a.$.extend(m, l[h[0]]);
                    2 == h.length && (m.left = "left" == h[1] ? e.left : e.left + e.width - d)
                }
                m.left -= a.$body.position().left;
                c = setTimeout(function () {
                    f.css(m).attr("class", ["uk-tooltip", "uk-tooltip-" + p, g.options.cls].join(" "));
                    g.options.animation ? f.css({
                            opacity: 0,
                            display: "block"
                        }).addClass(g.options.activeClass).animate({opacity: 1}, parseInt(g.options.animation, 10) || 400) : f.show().addClass(g.options.activeClass);
                    c = !1;
                    b = setInterval(function () {
                        g.element.is(":visible") || g.hide()
                    }, 150)
                }, parseInt(this.options.delay, 10) || 0)
            }
        }, hide: function () {
            if (!this.element.is("input") ||
                this.element[0] !== document.activeElement)if (c && clearTimeout(c), b && clearTimeout(b), f.stop(), this.options.animation) {
                var a = this;
                f.fadeOut(parseInt(this.options.animation, 10) || 400, function () {
                    f.removeClass(a.options.activeClass)
                })
            } else f.hide().removeClass(this.options.activeClass)
        }, content: function () {
            return this.tip
        }, checkBoundary: function (b, e, d, c) {
            var f = "";
            return (0 > b || b - a.$win.scrollLeft() + d > window.innerWidth) && (f += "x"), (0 > e || e - a.$win.scrollTop() + c > window.innerHeight) && (f += "y"), f
        }
    }), a.tooltip
});
!function (a) {
    var f;
    window.UIkit && (f = a(UIkit));
    "function" == typeof define && define.amd && define("uikit-notify", ["uikit"], function () {
        return f || a(UIkit)
    })
}(function (a) {
    var f = {}, c = {}, b = function (b, d) {
        return "string" == a.$.type(b) && (b = {message: b}), d && (b = a.$.extend(b, "string" == a.$.type(d) ? {status: d} : d)), (new g(b)).show()
    }, g = function (b) {
        this.options = a.$.extend({}, g.defaults, b);
        this.uuid = a.Utils.uid("notifymsg");
        this.element = a.$('<div class="uk-notify-message"><a class="uk-close"></a><div></div></div>').data("notifyMessage",
            this);
        this.content(this.options.message);
        this.options.status && (this.element.addClass("uk-notify-message-" + this.options.status), this.currentstatus = this.options.status);
        this.group = this.options.group;
        c[this.uuid] = this;
        f[this.options.pos] || (f[this.options.pos] = a.$('<div class="uk-notify uk-notify-' + this.options.pos + '"></div>').appendTo("body").on("click", ".uk-notify-message", function () {
            var b = a.$(this).data("notifyMessage");
            b.element.trigger("manualclose.uk.notify", [b]);
            b.close()
        }))
    };
    return a.$.extend(g.prototype,
        {
            uuid: !1, element: !1, timout: !1, currentstatus: "", group: !1, show: function () {
            if (!this.element.is(":visible")) {
                var a = this;
                f[this.options.pos].show().prepend(this.element);
                var b = parseInt(this.element.css("margin-bottom"), 10);
                return this.element.css({
                    opacity: 0,
                    "margin-top": -1 * this.element.outerHeight(),
                    "margin-bottom": 0
                }).animate({opacity: 1, "margin-top": 0, "margin-bottom": b}, function () {
                    if (a.options.timeout) {
                        var b = function () {
                            a.close()
                        };
                        a.timeout = setTimeout(b, a.options.timeout);
                        a.element.hover(function () {
                                clearTimeout(a.timeout)
                            },
                            function () {
                                a.timeout = setTimeout(b, a.options.timeout)
                            })
                    }
                }), this
            }
        }, close: function (a) {
            var b = this, g = function () {
                b.element.remove();
                f[b.options.pos].children().length || f[b.options.pos].hide();
                b.options.onClose.apply(b, []);
                b.element.trigger("close.uk.notify", [b]);
                delete c[b.uuid]
            };
            this.timeout && clearTimeout(this.timeout);
            a ? g() : this.element.animate({
                    opacity: 0,
                    "margin-top": -1 * this.element.outerHeight(),
                    "margin-bottom": 0
                }, function () {
                    g()
                })
        }, content: function (a) {
            var b = this.element.find(">div");
            return a ? (b.html(a),
                    this) : b.html()
        }, status: function (a) {
            return a ? (this.element.removeClass("uk-notify-message-" + this.currentstatus).addClass("uk-notify-message-" + a), this.currentstatus = a, this) : this.currentstatus
        }
        }), g.defaults = {
        message: "", status: "", timeout: 5E3, group: null, pos: "top-center", onClose: function () {
        }
    }, a.notify = b, a.notify.message = g, a.notify.closeAll = function (a, b) {
        var f;
        if (a)for (f in c)a === c[f].group && c[f].close(b); else for (f in c)c[f].close(b)
    }, b
});
!function (a) {
    var f;
    window.UIkit && (f = a(UIkit));
    "function" == typeof define && define.amd && define("uikit-lightbox", ["uikit"], function () {
        return f || a(UIkit)
    })
}(function (a) {
    function f(b) {
        return c ? (c.lightbox = b, c) : (c = a.$(['<div class="uk-modal">', '<div class="uk-modal-dialog uk-modal-dialog-lightbox uk-slidenav-position" style="margin-left:auto;margin-right:auto;width:200px;height:200px;top:' + Math.abs(window.innerHeight / 2 - 200) + 'px;">', '<a href="#" class="uk-modal-close uk-close uk-close-alt"></a><div class="uk-lightbox-content"></div><div class="uk-modal-spinner uk-hidden"></div></div></div>'].join("")).appendTo("body"),
                c.dialog = c.find(".uk-modal-dialog:first"), c.content = c.find(".uk-lightbox-content:first"), c.loader = c.find(".uk-modal-spinner:first"), c.closer = c.find(".uk-close.uk-close-alt"), c.modal = a.modal(c, {modal: !1}), c.on("swipeRight swipeLeft", function (a) {
                c.lightbox["swipeLeft" == a.type ? "next" : "previous"]()
            }).on("click", "[data-lightbox-previous], [data-lightbox-next]", function (b) {
                b.preventDefault();
                c.lightbox[a.$(this).is("[data-lightbox-next]") ? "next" : "previous"]()
            }), c.on("hide.uk.modal", function () {
                c.content.html("")
            }),
                a.$win.on("load resize orientationchange", a.Utils.debounce(function () {
                    c.is(":visible") && !a.Utils.isFullscreen() && c.lightbox.fitSize()
                }.bind(this), 100)), c.lightbox = b, c)
    }

    var c, b = {};
    return a.component("lightbox", {
        defaults: {group: !1, duration: 400, keyboard: !0}, index: 0, items: !1, boot: function () {
            a.$html.on("click", "[data-uk-lightbox]", function (b) {
                b.preventDefault();
                b = a.$(this);
                b.data("lightbox") || a.lightbox(b, a.Utils.options(b.attr("data-uk-lightbox")));
                b.data("lightbox").show(b)
            });
            a.$doc.on("keyup", function (a) {
                if (c &&
                    c.is(":visible") && c.lightbox.options.keyboard)switch (a.preventDefault(), a.keyCode) {
                    case 37:
                        c.lightbox.previous();
                        break;
                    case 39:
                        c.lightbox.next()
                }
            })
        }, init: function () {
            var b = [];
            if (this.index = 0, this.siblings = [], this.element && this.element.length) {
                var c = this.options.group ? a.$(['[data-uk-lightbox*="' + this.options.group + '"]', "[data-uk-lightbox*='" + this.options.group + "']"].join()) : this.element;
                c.each(function () {
                    var c = a.$(this);
                    b.push({
                        source: c.attr("href"),
                        title: c.attr("data-title") || c.attr("title"),
                        type: c.attr("data-lightbox-type") ||
                        "auto",
                        link: c
                    })
                });
                this.index = c.index(this.element);
                this.siblings = b
            } else this.options.group && this.options.group.length && (this.siblings = this.options.group);
            this.trigger("lightbox-init", [this])
        }, show: function (b) {
            this.modal = f(this);
            this.modal.dialog.stop();
            this.modal.content.stop();
            var c, d, k = this, l = a.$.Deferred();
            b = b || 0;
            "object" == typeof b && this.siblings.forEach(function (a, c) {
                b[0] === a.link[0] && (b = c)
            });
            0 > b ? b = this.siblings.length - b : this.siblings[b] || (b = 0);
            d = this.siblings[b];
            c = {
                lightbox: k,
                source: d.source,
                type: d.type,
                index: b,
                promise: l,
                title: d.title,
                item: d,
                meta: {content: "", width: null, height: null}
            };
            this.index = b;
            this.modal.content.empty();
            this.modal.is(":visible") || (this.modal.content.css({
                width: "",
                height: ""
            }).empty(), this.modal.modal.show());
            this.modal.loader.removeClass("uk-hidden");
            l.promise().done(function () {
                k.data = c;
                k.fitSize(c)
            }).fail(function () {
                c.meta.content = '<div class="uk-position-cover uk-flex uk-flex-middle uk-flex-center"><strong>Loading resource failed!</strong></div>';
                c.meta.width = 400;
                c.meta.height = 300;
                k.data = c;
                k.fitSize(c)
            });
            k.trigger("showitem.uk.lightbox", [c])
        }, fitSize: function () {
            var b = this, c = this.data, d = this.modal.dialog.outerWidth() - this.modal.dialog.width(), f = parseInt(this.modal.dialog.css("margin-top"), 10), l = parseInt(this.modal.dialog.css("margin-bottom"), 10), l = f + l, p = c.meta.content, f = b.options.duration;
            1 < this.siblings.length && (p = [p, '<a href="#" class="uk-slidenav uk-slidenav-contrast uk-slidenav-previous uk-hidden-touch" data-lightbox-previous></a><a href="#" class="uk-slidenav uk-slidenav-contrast uk-slidenav-next uk-hidden-touch" data-lightbox-next></a>'].join(""));
            var h, m, r = a.$("<div>&nbsp;</div>").css({
                opacity: 0,
                position: "absolute",
                top: 0,
                left: 0,
                width: "100%",
                "max-width": b.modal.dialog.css("max-width"),
                padding: b.modal.dialog.css("padding"),
                margin: b.modal.dialog.css("margin")
            }), n = c.meta.width, t = c.meta.height;
            r.appendTo("body").width();
            h = r.width();
            m = window.innerHeight - l;
            r.remove();
            this.modal.dialog.find(".uk-modal-caption").remove();
            c.title && (this.modal.dialog.append('<div class="uk-modal-caption">' + c.title + "</div>"), m -= this.modal.dialog.find(".uk-modal-caption").outerHeight());
            h < c.meta.width && (t = Math.floor(h / n * t), n = h);
            t > m && (t = Math.floor(m), n = Math.ceil(m / c.meta.height * c.meta.width));
            this.modal.content.css("opacity", 0).width(n).html(p);
            "iframe" == c.type && this.modal.content.find("iframe:first").height(t);
            c = Math.floor(window.innerHeight / 2 - (t + d) / 2) - l;
            0 > c && (c = 0);
            this.modal.closer.addClass("uk-hidden");
            b.modal.data("mwidth") == n && b.modal.data("mheight") == t && (f = 0);
            this.modal.dialog.animate({width: n + d, height: t + d, top: c}, f, "swing", function () {
                b.modal.loader.addClass("uk-hidden");
                b.modal.content.css({width: ""}).animate({opacity: 1},
                    function () {
                        b.modal.closer.removeClass("uk-hidden")
                    });
                b.modal.data({mwidth: n, mheight: t})
            })
        }, next: function () {
            this.show(this.siblings[this.index + 1] ? this.index + 1 : 0)
        }, previous: function () {
            this.show(this.siblings[this.index - 1] ? this.index - 1 : this.siblings.length - 1)
        }
    }), a.plugin("lightbox", "image", {
        init: function (a) {
            a.on("showitem.uk.lightbox", function (a, c) {
                if ("image" == c.type || c.source && c.source.match(/\.(jpg|jpeg|png|gif|svg)$/i)) {
                    var f = function (a, b, e) {
                        c.meta = {
                            content: '<img class="uk-responsive-width" width="' +
                            b + '" height="' + e + '" src ="' + a + '">', width: b, height: e
                        };
                        c.type = "image";
                        c.promise.resolve()
                    };
                    if (b[c.source]) f(c.source, b[c.source].width, b[c.source].height); else {
                        var g = new Image;
                        g.onerror = function () {
                            c.promise.reject("Loading image failed")
                        };
                        g.onload = function () {
                            b[c.source] = {width: g.width, height: g.height};
                            f(c.source, b[c.source].width, b[c.source].height)
                        };
                        g.src = c.source
                    }
                }
            })
        }
    }), a.plugin("lightbox", "youtube", {
        init: function (a) {
            var c = /(\/\/.*?youtube\.[a-z]+)\/watch\?v=([^&]+)&?(.*)/, d = /youtu\.be\/(.*)/;
            a.on("showitem.uk.lightbox",
                function (a, f) {
                    var g, h, m = function (a, b, c) {
                        f.meta = {
                            content: '<iframe src="//www.youtube.com/embed/' + a + '" width="' + b + '" height="' + c + '" style="max-width:100%;"></iframe>',
                            width: b,
                            height: c
                        };
                        f.type = "iframe";
                        f.promise.resolve()
                    };
                    if ((h = f.source.match(c)) && (g = h[2]), (h = f.source.match(d)) && (g = h[1]), g) {
                        if (b[g]) m(g, b[g].width, b[g].height); else {
                            var r = new Image, n = !1;
                            r.onerror = function () {
                                b[g] = {width: 640, height: 320};
                                m(g, b[g].width, b[g].height)
                            };
                            r.onload = function () {
                                120 == r.width && 90 == r.height ? n ? (b[g] = {width: 640, height: 320},
                                            m(g, b[g].width, b[g].height)) : (n = !0, r.src = "//img.youtube.com/vi/" + g + "/0.jpg") : (b[g] = {
                                        width: r.width,
                                        height: r.height
                                    }, m(g, r.width, r.height))
                            };
                            r.src = "//img.youtube.com/vi/" + g + "/maxresdefault.jpg"
                        }
                        a.stopImmediatePropagation()
                    }
                })
        }
    }), a.plugin("lightbox", "vimeo", {
        init: function (c) {
            var e, d = /(\/\/.*?)vimeo\.[a-z]+\/([0-9]+).*?/;
            c.on("showitem.uk.lightbox", function (c, f) {
                var g, h = function (a, b, c) {
                    f.meta = {
                        content: '<iframe src="//player.vimeo.com/video/' + a + '" width="' + b + '" height="' + c + '" style="width:100%;box-sizing:border-box;"></iframe>',
                        width: b, height: c
                    };
                    f.type = "iframe";
                    f.promise.resolve()
                };
                (e = f.source.match(d)) && (g = e[2], b[g] ? h(g, b[g].width, b[g].height) : a.$.ajax({
                        type: "GET",
                        url: "http://vimeo.com/api/oembed.json?url=" + encodeURI(f.source),
                        jsonp: "callback",
                        dataType: "jsonp",
                        success: function (a) {
                            b[g] = {width: a.width, height: a.height};
                            h(g, b[g].width, b[g].height)
                        }
                    }), c.stopImmediatePropagation())
            })
        }
    }), a.plugin("lightbox", "video", {
        init: function (c) {
            c.on("showitem.uk.lightbox", function (c, d) {
                var f = function (a, b, c) {
                    d.meta = {
                        content: '<video class="uk-responsive-width" src="' +
                        a + '" width="' + b + '" height="' + c + '" controls></video>', width: b, height: c
                    };
                    d.type = "video";
                    d.promise.resolve()
                };
                if ("video" == d.type || d.source.match(/\.(mp4|webm|ogv)$/i))if (b[d.source]) f(d.source, b[d.source].width, b[d.source].height); else var g = a.$('<video style="position:fixed;visibility:hidden;top:-10000px;"></video>').attr("src", d.source).appendTo("body"), p = setInterval(function () {
                    g[0].videoWidth && (clearInterval(p), b[d.source] = {
                        width: g[0].videoWidth,
                        height: g[0].videoHeight
                    }, f(d.source, b[d.source].width,
                        b[d.source].height), g.remove())
                }, 20)
            })
        }
    }), a.lightbox.create = function (b, c) {
        if (b) {
            var d = [];
            return b.forEach(function (b) {
                d.push(a.$.extend({
                    source: "",
                    title: "",
                    type: "auto",
                    link: !1
                }, "string" == typeof b ? {source: b} : b))
            }), a.lightbox(a.$.extend({}, c, {group: d}))
        }
    }, a.lightbox
});
function grin(a) {
    var f;
    a = " " + a + " ";
    if (document.getElementById("comment") && "textarea" == document.getElementById("comment").type) f = document.getElementById("comment"); else return !1;
    if (document.selection) f.focus(), sel = document.selection.createRange(), sel.text = a, f.focus(); else if (f.selectionStart || "0" == f.selectionStart) {
        var c = f.selectionEnd, b = c;
        f.value = f.value.substring(0, f.selectionStart) + a + f.value.substring(c, f.value.length);
        b += a.length;
        f.focus();
        f.selectionStart = b;
        f.selectionEnd = b
    } else f.value += a, f.focus()
}
function e_click() {
    $("#emojis_a").click(function () {
        $("#emojis_list").css("left", "30vw");
        $("#emojis_list").css("opacity", "0");
        $("#emojis_list").show();
        $("#emojis_list").animate({left: "0", opacity: "1"})
    });
    $("#emojis_list td").click(function () {
        $(this).parent().parent().parent().parent().fadeOut()
    })
}
function fen_qzhai() {
    if ("0" == $(".favorite").attr("cl")) {
        for (var a = 100, f = 1; 8 > f; f++)$(".fen li:nth-child(" + f + ")").css("transform", "rotate(" + a + "deg)"), $(".fen li:nth-child(" + f + ")").children().children().css("transform", "rotate(-" + a + "deg)"), $(".fen li:nth-child(" + f + ")").children().animate({fontSize: "1.4rem"}, 100, function () {
            $(this).css("opacity", "1");
            $(this).css("transform", "translate3d(0px, 90px, 0px)")
        }), a += 25;
        $(".favorite").attr("cl", "1");
        $("#index").mousemove(function (a) {
            var b = (event || a).clientX - this.offsetLeft,
                f = $(this).width() / 2;
            b < f ? $(".fen li").children().animate({}, function () {
                    $(this).css("transform", "translate3d(" + .102 * -(f - b) + "px, 90px, 0px)")
                }) : b > f && $(".fen li").children().animate({}, function () {
                    $(this).css("transform", "translate3d(" + .04 * b + "px, 90px, 0px)")
                })
        }).mouseout(function () {
            $(".fen li").children().animate({}, function () {
                $(this).css("transform", "translate3d(0px, 90px, 0px)")
            })
        })
    } else if ("1" == $(".favorite").attr("cl")) {
        a = 100;
        for (f = 1; 8 > f; f++)$(".fen li:nth-child(" + f + ")").children().animate({}, 400,
            function () {
                $(this).css("transform", "translate3d(0px, 0px, 0px)");
                $(this).css("opacity", "0")
            }), a += 25;
        $(".favorite").attr("cl", "0")
    }
}
$.fn.postLike = function () {
    if ($(this).hasClass("done")) $(this).animate({opacity: "0"}, 200), $(this).css("color", "#dd0055"), $(this).animate({opacity: "1"}), $(this).children("i").animate({fontSize: "1.3rem"}, 200, fen_qzhai()), $(this).children("i").animate({fontSize: "2.3rem"}, 150), $(this).children("i").animate({fontSize: "1.7rem"}, 150), $(this).children("i").animate({fontSize: "2rem"}, 100); else {
        $(this).addClass("done");
        var a = $(this).data("id"), f = $(this).data("action"), c = $(this).children("i");
        $.post(ajaxhome + "/wp-admin/admin-ajax.php",
            {action: "bigfa_like", um_id: a, um_action: f}, function (a) {
                $(c).attr("title", a + "\u4eba\u559c\u6b22")
            });
        $(this).animate({opacity: "0"}, 200);
        $(this).css("color", "#dd0055");
        $(this).animate({opacity: "1"});
        $(this).children("i").animate({fontSize: "1.3rem"}, 200, function () {
            $(".em03").animate({opacity: ".87", top: "-36px", left: "10px", fontSize: ".5rem"}, function () {
                $(".em02").animate({opacity: ".69", top: "-29px", left: "22px", fontSize: ".7rem"}, 200);
                $(".em02").animate({opacity: "0", fontSize: "1rem"});
                $(".em04").animate({
                    opacity: ".94",
                    top: "-22px", left: "-25px", fontSize: ".7rem"
                }, 400);
                $(".em04").animate({opacity: "0", fontSize: "1rem"})
            });
            $(".em03").animate({opacity: "0", fontSize: "1rem"});
            $(".em01").animate({opacity: ".49", top: "-35px", left: "-30px", fontSize: ".8rem"}, 500);
            $(".em01").animate({opacity: "0", fontSize: "1rem"});
            $(".em05").animate({opacity: ".74", top: "-20px", left: "-21px", fontSize: ".9rem"}, 200);
            $(".em05").animate({opacity: "0", fontSize: "1rem"})
        });
        $(this).children("i").animate({fontSize: "2.3rem"}, 150);
        $(this).children("i").animate({fontSize: "1.7rem"},
            150, fen_qzhai());
        $(this).children("i").animate({fontSize: "2rem"}, 100);
        return !1
    }
};
$(document).on("click", ".favorite i", function () {
    $(this).parent().postLike()
});
$(window).scroll(function () {
    50 < $(this).scrollTop() ? $(".top").fadeIn() : $(".top").fadeOut();
    $(this).scrollTop() >= $(document).height() - $(window).height() ? $(".icon_link").css("bottom", "20px") : $(".icon_link").css("bottom", "-80px")
});
$(function () {
    $("#op_m").click(function () {
        "lock" != $("#op_hed").attr("lock") ? ($("#op_hed").attr("lock", "lock"), $("#op_hed").animate({
                right: "250px",
                left: "-250px"
            }), $(".op").animate({width: "260px"}), $("#op_m").removeClass("uk-icon-music"), $("#op_m").addClass("uk-icon-close")) : "lock" == $("#op_hed").attr("lock") && ($("#op_hed").attr("lock", "open"), $("#op_hed").animate({
                right: "0px",
                left: "0px"
            }), $(".op").animate({width: "80%"}), $("#op_m").removeClass("uk-icon-close"), $("#op_m").addClass("uk-icon-music"))
    });
    $("#s_s a").click(function () {
        "#" != $(this).attr("href") && $("#s_s").click()
    })
});
function archive() {
    $(".car-collapse").find(".car-monthlisting").hide();
    $(".car-collapse").find(".car-monthlisting:first").show();
    $(".car-collapse").find(".car-yearmonth").click(function () {
        $(this).next("ul").slideToggle();
        $(this).parent("div").next("ul").slideToggle()
    });
    $(".car-collapse").find(".car-toggler").click(function () {
        "\u5c55\u5f00\u6240\u6709\u6708\u4efd" == jQuery(this).text() ? ($(this).parent(".car-container").find(".car-monthlisting").show(), $(this).text("\u6298\u53e0\u6240\u6709\u6708\u4efd")) :
            ($(this).parent(".car-container").find(".car-monthlisting").hide(), $(this).text("\u5c55\u5f00\u6240\u6709\u6708\u4efd"));
        return !1
    })
}
function comments() {
    $("#submit").click(function () {
        $("#comment").focus(function () {
            $(this).removeClass("uk-form-danger");
            $("#comment").attr("placeholder", "\u5185\u5bb9...")
        });
        $("#author").focus(function () {
            $(this).removeClass("uk-form-danger");
            $(this).attr("placeholder", "\u6635\u79f0*")
        });
        $("#email").focus(function () {
            $(this).removeClass("uk-form-danger");
            $(this).attr("placeholder", "\u90ae\u7bb1*")
        });
        if ("" == $("#comment").val())return $("#comment").addClass("uk-form-danger"), $("#comment").attr("placeholder",
            "\u5185\u5bb9\u4e0d\u80fd\u4e3a\u7a7a"), UIkit.notify("<i class='uk-icon-remove'></i> \u5185\u5bb9\u4e0d\u80fd\u4e3a\u7a7a", {
            pos: "bottom-right",
            status: "danger"
        }), !1;
        if ("" == $("#author").val())return $("#author").addClass("uk-form-danger"), $("#author").attr("placeholder", "\u6635\u79f0\u4e0d\u80fd\u4e3a\u7a7a"), UIkit.notify("<i class='uk-icon-remove'></i> \u6635\u79f0\u4e0d\u80fd\u4e3a\u7a7a", {
            pos: "bottom-right",
            status: "danger"
        }), !1;
        if ("" == $("#email").val())return $("#email").addClass("uk-form-danger"),
            $("#email").attr("placeholder", "\u90ae\u7bb1\u4e0d\u80fd\u4e3a\u7a7a"), UIkit.notify("<i class='uk-icon-remove'></i> \u90ae\u7bb1\u4e0d\u80fd\u4e3a\u7a7a", {
            pos: "bottom-right",
            status: "danger"
        }), !1
    });
    $("article.uk-comment").mousemove(function () {
        $(this).children("h6").children("span").show()
    }).mouseout(function () {
        $(this).children("h6").children("span").hide()
    })
}
function link_target() {
    $("#link_qzhai").children().children().attr("target", "_blank")
}
var ajaxcontent = "content", ajaxsearch_class = "s", ajaxloading_error_code = '<div id="index" class="bs" style="width:100%; height:80vh"><h4>\u52a0\u8f7d\u5931\u8d25</h4> <article id="article" class="uk-article"><p>\u52a0\u8f7d\u5931\u8d25 ...</p></article></div>', ajaxreloadDocumentReady = !1, ajaxtrack_analytics = !1, ajaxscroll_top = !0, ajaxisLoad = !1, ajaxstarted = !1, ajaxsearchPath = null, ajaxua = jQuery.browser;
jQuery(document).ready(function () {
    ajaxloadPageInit("");
    $("#article img").parent("a").attr("data-uk-lightbox", "{group:'group_qzhai'}");
    archive();
    comments();
    UIkit.sticky($("#ulsid"), {});
    $(".rewards").click(function () {
        UIkit.modal("#reward").show()
    });
    link_target();
    e_click();
    app()
});
window.onpopstate = function (a) {
    !0 === ajaxstarted && 1 == ajaxcheck_ignore(document.location.toString()) && ajaxloadPage(document.location.toString(), 1)
};
function ajaxloadPageInit(a) {
    jQuery(a + "a").click(function (a) {
        if (0 <= this.href.indexOf(ajaxhome) && 1 == ajaxcheck_ignore(this.href)) {
            a.preventDefault();
            this.blur();
            try {
                ajaxclick_code(this)
            } catch (c) {
            }
            ajaxloadPage(this.href)
        }
    });
    jQuery("." + ajaxsearch_class).each(function (a) {
        jQuery(this).attr("action") && (ajaxsearchPath = jQuery(this).attr("action"), jQuery(this).submit(function () {
            submitSearch(jQuery(this).serialize());
            return !1
        }))
    });
    jQuery("." + ajaxsearch_class).attr("action")
}
function ajaxloadPage(a, f, c) {
    ajaxisLoad || (1 == ajaxscroll_top && jQuery("html,body").animate({scrollTop: 0}, 1500), ajaxstarted = ajaxisLoad = !0, nohttp = a.replace("http://", "").replace("https://", ""), firstsla = nohttp.indexOf("/"), pathpos = a.indexOf(nohttp), path = a.substring(pathpos + firstsla), 1 != f && "function" == typeof window.history.pushState && history.pushState({foo: 1E3 + 1001 * Math.random()}, "ajax page loaded...", path), jQuery("#" + ajaxcontent), jQuery("#" + ajaxcontent).append(ajaxloading_code), jQuery("#index").children().fadeTo("slow",
        0, function () {
        }), jQuery("#" + ajaxcontent).fadeTo("slow", 1, function () {
        jQuery("#" + ajaxcontent).fadeIn("slow", function () {
            jQuery.ajax({
                type: "GET", url: a, data: c, cache: !1, dataType: "html", success: function (a) {
                    ajaxisLoad = !1;
                    datax = a.split("<title>");
                    titlesx = a.split("</title>");
                    if (2 == datax.length || 2 == titlesx.length) a = a.split("<title>")[1], titles = a.split("</title>")[0], jQuery(document).attr("title", jQuery("<div/>").html(titles).text());
                    1 == ajaxtrack_analytics && "undefined" != typeof _gaq && (c = "undefined" == typeof c ? "" :
                        "?" + c, _gaq.push(["_trackPageview", path + c]));
                    a = a.split('id="' + ajaxcontent + '"')[1];
                    a = a.substring(a.indexOf(">") + 1);
                    for (var f = 1, e = ""; 0 < f;) {
                        temp = a.split("</div>")[0];
                        i = 0;
                        for (pos = temp.indexOf("<div"); -1 != pos;)i++, pos = temp.indexOf("<div", pos + 1);
                        f = f + i - 1;
                        e = e + a.split("</div>")[0] + "</div>";
                        a = a.substring(a.indexOf("</div>") + 6)
                    }
                    document.getElementById(ajaxcontent).innerHTML = e;
                    jQuery("#" + ajaxcontent).css("position", "absolute");
                    jQuery("#" + ajaxcontent).css("left", "20000px");
                    jQuery("#" + ajaxcontent).show();
                    ajaxloadPageInit("#" +
                        ajaxcontent + " ");
                    1 == ajaxreloadDocumentReady && jQuery(document).trigger("ready");
                    try {
                        ajaxreload_code()
                    } catch (d) {
                    }
                    jQuery("#index").children().hide();
                    jQuery("#" + ajaxcontent).css("position", "");
                    jQuery("#" + ajaxcontent).css("left", "");
                    jQuery("#index").children().fadeIn()
                }, error: function (a, c, e) {
                    ajaxisLoad = !1;
                    document.title = "Error loading requested page!";
                    document.getElementById(ajaxcontent).innerHTML = ajaxloading_error_code
                }
            })
        })
    }))
}
function submitSearch(a) {
    ajaxisLoad || ajaxloadPage(ajaxsearchPath, 0, a)
}
function ajaxcheck_ignore(a) {
    for (var f in ajaxignore)if (0 <= a.indexOf(ajaxignore[f]))return !1;
    return !0
}
function ajaxreload_code() {
    $("#article img").parent("a").attr("data-uk-lightbox", "{group:'group_qzhai'}");
    archive();
    comments();
    UIkit.sticky($("#ulsid"), {});
    $(".rewards").click(function () {
        UIkit.modal("#reward").show()
    });
    link_target();
    e_click();
    app()
}
function ajaxclick_code(a) {
    jQuery("ul.nav li").each(function () {
        jQuery(this).removeClass(" uk-active")
    });
    jQuery(a).parents("li").addClass("uk-active")
};
//# sourceMappingURL=blog.js.map
