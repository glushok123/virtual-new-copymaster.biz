/*
 Highcharts JS v8.2.0 (2020-08-20)

 (c) 2009-2018 Torstein Honsi

 License: www.highcharts.com/license
*/
(function (T, O) {
    "object" === typeof module && module.exports ? (O["default"] = O, module.exports = T.document ? O(T) : O) : "function" === typeof define && define.amd ? define("highcharts/highcharts", function () {
        return O(T)
    }) : (T.Highcharts && T.Highcharts.error(16, !0), T.Highcharts = O(T))
})("undefined" !== typeof window ? window : this, function (T) {
    function O(f, a, S, y) {
        f.hasOwnProperty(a) || (f[a] = y.apply(null, S))
    }
    var n = {};
    O(n, "Core/Globals.js", [], function () {
        var f = "undefined" !== typeof T ? T : "undefined" !== typeof window ? window : {},
            a = f.document,
            S = f.navigator && f.navigator.userAgent || "",
            y = a && a.createElementNS && !!a.createElementNS("http://www.w3.org/2000/svg", "svg").createSVGRect,
            n = /(edge|msie|trident)/i.test(S) && !f.opera,
            G = -1 !== S.indexOf("Firefox"),
            C = -1 !== S.indexOf("Chrome"),
            J = G && 4 > parseInt(S.split("Firefox/")[1], 10);
        return {
            product: "Highcharts",
            version: "8.2.0",
            deg2rad: 2 * Math.PI / 360,
            doc: a,
            hasBidiBug: J,
            hasTouch: !!f.TouchEvent,
            isMS: n,
            isWebKit: -1 !== S.indexOf("AppleWebKit"),
            isFirefox: G,
            isChrome: C,
            isSafari: !C && -1 !== S.indexOf("Safari"),
            isTouchDevice: /(Mobile|Android|Windows Phone)/.test(S),
            SVG_NS: "http://www.w3.org/2000/svg",
            chartCount: 0,
            seriesTypes: {},
            symbolSizes: {},
            svg: y,
            win: f,
            marginNames: ["plotTop", "marginRight", "marginBottom", "plotLeft"],
            noop: function () {},
            charts: [],
            dateFormats: {}
        }
    });
    O(n, "Core/Utilities.js", [n["Core/Globals.js"]], function (f) {
        function a(b, c, e, d) {
            var z = c ? "Highcharts error" : "Highcharts warning";
            32 === b && (b = z + ": Deprecated member");
            var w = I(b),
                g = w ? z + " #" + b + ": www.highcharts.com/errors/" + b + "/" : b.toString();
            z = function () {
                if (c) throw Error(g);
                v.console && -1 === a.messages.indexOf(g) &&
                    console.log(g)
            };
            if ("undefined" !== typeof d) {
                var k = "";
                w && (g += "?");
                U(d, function (b, c) {
                    k += "\n - " + c + ": " + b;
                    w && (g += encodeURI(c) + "=" + encodeURI(b))
                });
                g += k
            }
            e ? ea(e, "displayError", {
                code: b,
                message: g,
                params: d
            }, z) : z();
            a.messages.push(g)
        }

        function S() {
            var b, c = arguments,
                e = {},
                d = function (b, c) {
                    "object" !== typeof b && (b = {});
                    U(c, function (e, z) {
                        !y(e, !0) || t(e) || p(e) ? b[z] = c[z] : b[z] = d(b[z] || {}, e)
                    });
                    return b
                };
            !0 === c[0] && (e = c[1], c = Array.prototype.slice.call(c, 2));
            var z = c.length;
            for (b = 0; b < z; b++) e = d(e, c[b]);
            return e
        }

        function y(b,
            c) {
            return !!b && "object" === typeof b && (!c || !E(b))
        }

        function n(b, c, e) {
            var d;
            K(c) ? m(e) ? b.setAttribute(c, e) : b && b.getAttribute && ((d = b.getAttribute(c)) || "class" !== c || (d = b.getAttribute(c + "Name"))) : U(c, function (c, e) {
                b.setAttribute(e, c)
            });
            return d
        }

        function G() {
            for (var b = arguments, c = b.length, e = 0; e < c; e++) {
                var d = b[e];
                if ("undefined" !== typeof d && null !== d) return d
            }
        }

        function C(b, c) {
            if (!b) return c;
            var e = b.split(".").reverse();
            if (1 === e.length) return c[b];
            for (b = e.pop();
                "undefined" !== typeof b && "undefined" !== typeof c && null !==
                c;) c = c[b], b = e.pop();
            return c
        }
        f.timers = [];
        var J = f.charts,
            H = f.doc,
            v = f.win;
        (a || (a = {})).messages = [];
        f.error = a;
        var L = function () {
            function b(b, c, e) {
                this.options = c;
                this.elem = b;
                this.prop = e
            }
            b.prototype.dSetter = function () {
                var b = this.paths,
                    c = b && b[0];
                b = b && b[1];
                var e = [],
                    d = this.now || 0;
                if (1 !== d && c && b)
                    if (c.length === b.length && 1 > d)
                        for (var z = 0; z < b.length; z++) {
                            for (var w = c[z], g = b[z], k = [], h = 0; h < g.length; h++) {
                                var P = w[h],
                                    l = g[h];
                                k[h] = "number" === typeof P && "number" === typeof l && ("A" !== g[0] || 4 !== h && 5 !== h) ? P + d * (l - P) : l
                            }
                            e.push(k)
                        } else e =
                            b;
                    else e = this.toD || [];
                this.elem.attr("d", e, void 0, !0)
            };
            b.prototype.update = function () {
                var b = this.elem,
                    c = this.prop,
                    e = this.now,
                    d = this.options.step;
                if (this[c + "Setter"]) this[c + "Setter"]();
                else b.attr ? b.element && b.attr(c, e, null, !0) : b.style[c] = e + this.unit;
                d && d.call(b, e, this)
            };
            b.prototype.run = function (b, c, e) {
                var d = this,
                    z = d.options,
                    w = function (b) {
                        return w.stopped ? !1 : d.step(b)
                    },
                    g = v.requestAnimationFrame || function (b) {
                        setTimeout(b, 13)
                    },
                    h = function () {
                        for (var b = 0; b < f.timers.length; b++) f.timers[b]() || f.timers.splice(b--,
                            1);
                        f.timers.length && g(h)
                    };
                b !== c || this.elem["forceAnimate:" + this.prop] ? (this.startTime = +new Date, this.start = b, this.end = c, this.unit = e, this.now = this.start, this.pos = 0, w.elem = this.elem, w.prop = this.prop, w() && 1 === f.timers.push(w) && g(h)) : (delete z.curAnim[this.prop], z.complete && 0 === Object.keys(z.curAnim).length && z.complete.call(this.elem))
            };
            b.prototype.step = function (b) {
                var c = +new Date,
                    e = this.options,
                    d = this.elem,
                    z = e.complete,
                    w = e.duration,
                    g = e.curAnim;
                if (d.attr && !d.element) b = !1;
                else if (b || c >= w + this.startTime) {
                    this.now =
                        this.end;
                    this.pos = 1;
                    this.update();
                    var h = g[this.prop] = !0;
                    U(g, function (b) {
                        !0 !== b && (h = !1)
                    });
                    h && z && z.call(d);
                    b = !1
                } else this.pos = e.easing((c - this.startTime) / w), this.now = this.start + (this.end - this.start) * this.pos, this.update(), b = !0;
                return b
            };
            b.prototype.initPath = function (b, c, e) {
                function d(b, c) {
                    for (; b.length < r;) {
                        var e = b[0],
                            d = c[r - b.length];
                        d && "M" === e[0] && (b[0] = "C" === d[0] ? ["C", e[1], e[2], e[1], e[2], e[1], e[2]] : ["L", e[1], e[2]]);
                        b.unshift(e);
                        h && b.push(b[b.length - 1])
                    }
                }

                function z(b, c) {
                    for (; b.length < r;)
                        if (c = b[b.length /
                                k - 1].slice(), "C" === c[0] && (c[1] = c[5], c[2] = c[6]), h) {
                            var e = b[b.length / k].slice();
                            b.splice(b.length / 2, 0, c, e)
                        } else b.push(c)
                }
                var w = b.startX,
                    g = b.endX;
                c = c && c.slice();
                e = e.slice();
                var h = b.isArea,
                    k = h ? 2 : 1;
                if (!c) return [e, e];
                if (w && g) {
                    for (b = 0; b < w.length; b++)
                        if (w[b] === g[0]) {
                            var P = b;
                            break
                        } else if (w[0] === g[g.length - w.length + b]) {
                        P = b;
                        var l = !0;
                        break
                    } else if (w[w.length - 1] === g[g.length - w.length + b]) {
                        P = w.length - b;
                        break
                    }
                    "undefined" === typeof P && (c = [])
                }
                if (c.length && I(P)) {
                    var r = e.length + P * k;
                    l ? (d(c, e), z(e, c)) : (d(e, c), z(c, e))
                }
                return [c,
                    e
                ]
            };
            b.prototype.fillSetter = function () {
                b.prototype.strokeSetter.apply(this, arguments)
            };
            b.prototype.strokeSetter = function () {
                this.elem.attr(this.prop, f.color(this.start).tweenTo(f.color(this.end), this.pos), null, !0)
            };
            return b
        }();
        f.Fx = L;
        f.merge = S;
        var q = f.pInt = function (b, c) {
                return parseInt(b, c || 10)
            },
            K = f.isString = function (b) {
                return "string" === typeof b
            },
            E = f.isArray = function (b) {
                b = Object.prototype.toString.call(b);
                return "[object Array]" === b || "[object Array Iterator]" === b
            };
        f.isObject = y;
        var p = f.isDOMElement = function (b) {
                return y(b) &&
                    "number" === typeof b.nodeType
            },
            t = f.isClass = function (b) {
                var c = b && b.constructor;
                return !(!y(b, !0) || p(b) || !c || !c.name || "Object" === c.name)
            },
            I = f.isNumber = function (b) {
                return "number" === typeof b && !isNaN(b) && Infinity > b && -Infinity < b
            },
            u = f.erase = function (b, c) {
                for (var e = b.length; e--;)
                    if (b[e] === c) {
                        b.splice(e, 1);
                        break
                    }
            },
            m = f.defined = function (b) {
                return "undefined" !== typeof b && null !== b
            };
        f.attr = n;
        var h = f.splat = function (b) {
                return E(b) ? b : [b]
            },
            l = f.syncTimeout = function (b, c, e) {
                if (0 < c) return setTimeout(b, c, e);
                b.call(0, e);
                return -1
            },
            k = f.clearTimeout = function (b) {
                m(b) && clearTimeout(b)
            },
            g = f.extend = function (b, c) {
                var e;
                b || (b = {});
                for (e in c) b[e] = c[e];
                return b
            };
        f.pick = G;
        var d = f.css = function (b, c) {
                f.isMS && !f.svg && c && "undefined" !== typeof c.opacity && (c.filter = "alpha(opacity=" + 100 * c.opacity + ")");
                g(b.style, c)
            },
            x = f.createElement = function (b, c, e, z, w) {
                b = H.createElement(b);
                c && g(b, c);
                w && d(b, {
                    padding: "0",
                    border: "none",
                    margin: "0"
                });
                e && d(b, e);
                z && z.appendChild(b);
                return b
            },
            r = f.extendClass = function (b, c) {
                var e = function () {};
                e.prototype = new b;
                g(e.prototype,
                    c);
                return e
            },
            A = f.pad = function (b, c, e) {
                return Array((c || 2) + 1 - String(b).replace("-", "").length).join(e || "0") + b
            },
            N = f.relativeLength = function (b, c, e) {
                return /%$/.test(b) ? c * parseFloat(b) / 100 + (e || 0) : parseFloat(b)
            },
            B = f.wrap = function (b, c, e) {
                var d = b[c];
                b[c] = function () {
                    var b = Array.prototype.slice.call(arguments),
                        c = arguments,
                        z = this;
                    z.proceed = function () {
                        d.apply(z, arguments.length ? arguments : c)
                    };
                    b.unshift(d);
                    b = e.apply(this, b);
                    z.proceed = null;
                    return b
                }
            },
            M = f.format = function (b, c, e) {
                var d = "{",
                    z = !1,
                    w = [],
                    g = /f$/,
                    h = /\.([0-9])/,
                    k = f.defaultOptions.lang,
                    P = e && e.time || f.time;
                for (e = e && e.numberFormatter || X; b;) {
                    var l = b.indexOf(d);
                    if (-1 === l) break;
                    var r = b.slice(0, l);
                    if (z) {
                        r = r.split(":");
                        d = C(r.shift() || "", c);
                        if (r.length && "number" === typeof d)
                            if (r = r.join(":"), g.test(r)) {
                                var m = parseInt((r.match(h) || ["", "-1"])[1], 10);
                                null !== d && (d = e(d, m, k.decimalPoint, -1 < r.indexOf(",") ? k.thousandsSep : ""))
                            } else d = P.dateFormat(r, d);
                        w.push(d)
                    } else w.push(r);
                    b = b.slice(l + 1);
                    d = (z = !z) ? "}" : "{"
                }
                w.push(b);
                return w.join("")
            },
            R = f.getMagnitude = function (b) {
                return Math.pow(10,
                    Math.floor(Math.log(b) / Math.LN10))
            },
            F = f.normalizeTickInterval = function (b, c, e, d, z) {
                var w = b;
                e = G(e, 1);
                var g = b / e;
                c || (c = z ? [1, 1.2, 1.5, 2, 2.5, 3, 4, 5, 6, 8, 10] : [1, 2, 2.5, 5, 10], !1 === d && (1 === e ? c = c.filter(function (b) {
                    return 0 === b % 1
                }) : .1 >= e && (c = [1 / e])));
                for (d = 0; d < c.length && !(w = c[d], z && w * e >= b || !z && g <= (c[d] + (c[d + 1] || c[d])) / 2); d++);
                return w = P(w * e, -Math.round(Math.log(.001) / Math.LN10))
            },
            e = f.stableSort = function (b, c) {
                var e = b.length,
                    d, z;
                for (z = 0; z < e; z++) b[z].safeI = z;
                b.sort(function (b, e) {
                    d = c(b, e);
                    return 0 === d ? b.safeI - e.safeI :
                        d
                });
                for (z = 0; z < e; z++) delete b[z].safeI
            },
            c = f.arrayMin = function (b) {
                for (var c = b.length, e = b[0]; c--;) b[c] < e && (e = b[c]);
                return e
            },
            b = f.arrayMax = function (b) {
                for (var c = b.length, e = b[0]; c--;) b[c] > e && (e = b[c]);
                return e
            },
            z = f.destroyObjectProperties = function (b, c) {
                U(b, function (e, d) {
                    e && e !== c && e.destroy && e.destroy();
                    delete b[d]
                })
            },
            w = f.discardElement = function (b) {
                var c = f.garbageBin;
                c || (c = x("div"));
                b && c.appendChild(b);
                c.innerHTML = ""
            },
            P = f.correctFloat = function (b, c) {
                return parseFloat(b.toPrecision(c || 14))
            },
            Z = f.setAnimation =
            function (b, c) {
                c.renderer.globalAnimation = G(b, c.options.chart.animation, !0)
            },
            W = f.animObject = function (b) {
                return y(b) ? f.merge({
                    duration: 500,
                    defer: 0
                }, b) : {
                    duration: b ? 500 : 0,
                    defer: 0
                }
            },
            aa = f.timeUnits = {
                millisecond: 1,
                second: 1E3,
                minute: 6E4,
                hour: 36E5,
                day: 864E5,
                week: 6048E5,
                month: 24192E5,
                year: 314496E5
            },
            X = f.numberFormat = function (b, c, e, d) {
                b = +b || 0;
                c = +c;
                var z = f.defaultOptions.lang,
                    w = (b.toString().split(".")[1] || "").split("e")[0].length,
                    g = b.toString().split("e");
                if (-1 === c) c = Math.min(w, 20);
                else if (!I(c)) c = 2;
                else if (c &&
                    g[1] && 0 > g[1]) {
                    var h = c + +g[1];
                    0 <= h ? (g[0] = (+g[0]).toExponential(h).split("e")[0], c = h) : (g[0] = g[0].split(".")[0] || 0, b = 20 > c ? (g[0] * Math.pow(10, g[1])).toFixed(c) : 0, g[1] = 0)
                }
                var k = (Math.abs(g[1] ? g[0] : b) + Math.pow(10, -Math.max(c, w) - 1)).toFixed(c);
                w = String(q(k));
                h = 3 < w.length ? w.length % 3 : 0;
                e = G(e, z.decimalPoint);
                d = G(d, z.thousandsSep);
                b = (0 > b ? "-" : "") + (h ? w.substr(0, h) + d : "");
                b += w.substr(h).replace(/(\d{3})(?=\d)/g, "$1" + d);
                c && (b += e + k.slice(-c));
                g[1] && 0 !== +b && (b += "e" + g[1]);
                return b
            };
        Math.easeInOutSine = function (b) {
            return -.5 *
                (Math.cos(Math.PI * b) - 1)
        };
        var ba = f.getStyle = function (b, c, e) {
                if ("width" === c) return c = Math.min(b.offsetWidth, b.scrollWidth), e = b.getBoundingClientRect && b.getBoundingClientRect().width, e < c && e >= c - 1 && (c = Math.floor(e)), Math.max(0, c - f.getStyle(b, "padding-left") - f.getStyle(b, "padding-right"));
                if ("height" === c) return Math.max(0, Math.min(b.offsetHeight, b.scrollHeight) - f.getStyle(b, "padding-top") - f.getStyle(b, "padding-bottom"));
                v.getComputedStyle || a(27, !0);
                if (b = v.getComputedStyle(b, void 0)) b = b.getPropertyValue(c),
                    G(e, "opacity" !== c) && (b = q(b));
                return b
            },
            ca = f.getDeferredAnimation = function (b, c, e) {
                var d = W(c),
                    z = 0,
                    w = 0;
                (e ? [e] : b.series).forEach(function (b) {
                    b = W(b.options.animation);
                    z = c && m(c.defer) ? d.defer : Math.max(z, b.duration + b.defer);
                    w = Math.min(d.duration, b.duration)
                });
                b.renderer.forExport && (z = 0);
                return {
                    defer: Math.max(0, z - w),
                    duration: Math.min(z, w)
                }
            },
            Y = f.inArray = function (b, c, e) {
                a(32, !1, void 0, {
                    "Highcharts.inArray": "use Array.indexOf"
                });
                return c.indexOf(b, e)
            },
            V = f.find = Array.prototype.find ? function (b, c) {
                return b.find(c)
            } :
            function (b, c) {
                var e, d = b.length;
                for (e = 0; e < d; e++)
                    if (c(b[e], e)) return b[e]
            };
        f.keys = function (b) {
            a(32, !1, void 0, {
                "Highcharts.keys": "use Object.keys"
            });
            return Object.keys(b)
        };
        var Q = f.offset = function (b) {
                var c = H.documentElement;
                b = b.parentElement || b.parentNode ? b.getBoundingClientRect() : {
                    top: 0,
                    left: 0
                };
                return {
                    top: b.top + (v.pageYOffset || c.scrollTop) - (c.clientTop || 0),
                    left: b.left + (v.pageXOffset || c.scrollLeft) - (c.clientLeft || 0)
                }
            },
            fa = f.stop = function (b, c) {
                for (var e = f.timers.length; e--;) f.timers[e].elem !== b || c && c !==
                    f.timers[e].prop || (f.timers[e].stopped = !0)
            },
            U = f.objectEach = function (b, c, e) {
                for (var d in b) Object.hasOwnProperty.call(b, d) && c.call(e || b[d], b[d], d, b)
            };
        U({
            map: "map",
            each: "forEach",
            grep: "filter",
            reduce: "reduce",
            some: "some"
        }, function (b, c) {
            f[c] = function (e) {
                var d;
                a(32, !1, void 0, (d = {}, d["Highcharts." + c] = "use Array." + b, d));
                return Array.prototype[b].apply(e, [].slice.call(arguments, 1))
            }
        });
        var ja = f.addEvent = function (b, c, e, d) {
                void 0 === d && (d = {});
                var z = b.addEventListener || f.addEventListenerPolyfill;
                var w = "function" ===
                    typeof b && b.prototype ? b.prototype.protoEvents = b.prototype.protoEvents || {} : b.hcEvents = b.hcEvents || {};
                f.Point && b instanceof f.Point && b.series && b.series.chart && (b.series.chart.runTrackerClick = !0);
                z && z.call(b, c, e, !1);
                w[c] || (w[c] = []);
                w[c].push({
                    fn: e,
                    order: "number" === typeof d.order ? d.order : Infinity
                });
                w[c].sort(function (b, c) {
                    return b.order - c.order
                });
                return function () {
                    ha(b, c, e)
                }
            },
            ha = f.removeEvent = function (b, c, e) {
                function d(c, e) {
                    var d = b.removeEventListener || f.removeEventListenerPolyfill;
                    d && d.call(b, c, e, !1)
                }

                function z(e) {
                    var z;
                    if (b.nodeName) {
                        if (c) {
                            var w = {};
                            w[c] = !0
                        } else w = e;
                        U(w, function (b, c) {
                            if (e[c])
                                for (z = e[c].length; z--;) d(c, e[c][z].fn)
                        })
                    }
                }
                var w;
                ["protoEvents", "hcEvents"].forEach(function (g, h) {
                    var k = (h = h ? b : b.prototype) && h[g];
                    k && (c ? (w = k[c] || [], e ? (k[c] = w.filter(function (b) {
                        return e !== b.fn
                    }), d(c, e)) : (z(k), k[c] = [])) : (z(k), h[g] = {}))
                })
            },
            ea = f.fireEvent = function (b, c, e, d) {
                var z;
                e = e || {};
                if (H.createEvent && (b.dispatchEvent || b.fireEvent)) {
                    var w = H.createEvent("Events");
                    w.initEvent(c, !0, !0);
                    g(w, e);
                    b.dispatchEvent ?
                        b.dispatchEvent(w) : b.fireEvent(c, w)
                } else e.target || g(e, {
                        preventDefault: function () {
                            e.defaultPrevented = !0
                        },
                        target: b,
                        type: c
                    }),
                    function (c, d) {
                        void 0 === c && (c = []);
                        void 0 === d && (d = []);
                        var w = 0,
                            g = 0,
                            h = c.length + d.length;
                        for (z = 0; z < h; z++) !1 === (c[w] ? d[g] ? c[w].order <= d[g].order ? c[w++] : d[g++] : c[w++] : d[g++]).fn.call(b, e) && e.preventDefault()
                    }(b.protoEvents && b.protoEvents[c], b.hcEvents && b.hcEvents[c]);
                d && !e.defaultPrevented && d.call(b, e)
            },
            ka = f.animate = function (b, c, e) {
                var d, z = "",
                    w, g;
                if (!y(e)) {
                    var h = arguments;
                    e = {
                        duration: h[2],
                        easing: h[3],
                        complete: h[4]
                    }
                }
                I(e.duration) || (e.duration = 400);
                e.easing = "function" === typeof e.easing ? e.easing : Math[e.easing] || Math.easeInOutSine;
                e.curAnim = S(c);
                U(c, function (h, k) {
                    fa(b, k);
                    g = new L(b, e, k);
                    w = null;
                    "d" === k && E(c.d) ? (g.paths = g.initPath(b, b.pathArray, c.d), g.toD = c.d, d = 0, w = 1) : b.attr ? d = b.attr(k) : (d = parseFloat(ba(b, k)) || 0, "opacity" !== k && (z = "px"));
                    w || (w = h);
                    w && w.match && w.match("px") && (w = w.replace(/px/g, ""));
                    g.run(d, w, z)
                })
            },
            la = f.seriesType = function (b, c, e, d, z) {
                var w = ia(),
                    g = f.seriesTypes;
                w.plotOptions[b] =
                    S(w.plotOptions[c], e);
                g[b] = r(g[c] || function () {}, d);
                g[b].prototype.type = b;
                z && (g[b].prototype.pointClass = r(f.Point, z));
                return g[b]
            },
            da, ma = f.uniqueKey = function () {
                var b = Math.random().toString(36).substring(2, 9) + "-",
                    c = 0;
                return function () {
                    return "highcharts-" + (da ? "" : b) + c++
                }
            }(),
            O = f.useSerialIds = function (b) {
                return da = G(b, da)
            },
            na = f.isFunction = function (b) {
                return "function" === typeof b
            },
            ia = f.getOptions = function () {
                return f.defaultOptions
            },
            oa = f.setOptions = function (b) {
                f.defaultOptions = S(!0, f.defaultOptions, b);
                (b.time ||
                    b.global) && f.time.update(S(f.defaultOptions.global, f.defaultOptions.time, b.global, b.time));
                return f.defaultOptions
            };
        v.jQuery && (v.jQuery.fn.highcharts = function () {
            var b = [].slice.call(arguments);
            if (this[0]) return b[0] ? (new(f[K(b[0]) ? b.shift() : "Chart"])(this[0], b[0], b[1]), this) : J[n(this[0], "data-highcharts-chart")]
        });
        return {
            Fx: f.Fx,
            addEvent: ja,
            animate: ka,
            animObject: W,
            arrayMax: b,
            arrayMin: c,
            attr: n,
            clamp: function (b, c, e) {
                return b > c ? b < e ? b : e : c
            },
            clearTimeout: k,
            correctFloat: P,
            createElement: x,
            css: d,
            defined: m,
            destroyObjectProperties: z,
            discardElement: w,
            erase: u,
            error: a,
            extend: g,
            extendClass: r,
            find: V,
            fireEvent: ea,
            format: M,
            getDeferredAnimation: ca,
            getMagnitude: R,
            getNestedProperty: C,
            getOptions: ia,
            getStyle: ba,
            inArray: Y,
            isArray: E,
            isClass: t,
            isDOMElement: p,
            isFunction: na,
            isNumber: I,
            isObject: y,
            isString: K,
            merge: S,
            normalizeTickInterval: F,
            numberFormat: X,
            objectEach: U,
            offset: Q,
            pad: A,
            pick: G,
            pInt: q,
            relativeLength: N,
            removeEvent: ha,
            seriesType: la,
            setAnimation: Z,
            setOptions: oa,
            splat: h,
            stableSort: e,
            stop: fa,
            syncTimeout: l,
            timeUnits: aa,
            uniqueKey: ma,
            useSerialIds: O,
            wrap: B
        }
    });
    O(n, "Core/Color.js", [n["Core/Globals.js"], n["Core/Utilities.js"]], function (f, a) {
        var S = a.isNumber,
            y = a.merge,
            n = a.pInt;
        a = function () {
            function a(f) {
                this.parsers = [{
                    regex: /rgba\(\s*([0-9]{1,3})\s*,\s*([0-9]{1,3})\s*,\s*([0-9]{1,3})\s*,\s*([0-9]?(?:\.[0-9]+)?)\s*\)/,
                    parse: function (a) {
                        return [n(a[1]), n(a[2]), n(a[3]), parseFloat(a[4], 10)]
                    }
                }, {
                    regex: /rgb\(\s*([0-9]{1,3})\s*,\s*([0-9]{1,3})\s*,\s*([0-9]{1,3})\s*\)/,
                    parse: function (a) {
                        return [n(a[1]), n(a[2]), n(a[3]), 1]
                    }
                }];
                this.rgba = [];
                if (!(this instanceof a)) return new a(f);
                this.init(f)
            }
            a.parse = function (f) {
                return new a(f)
            };
            a.prototype.init = function (f) {
                var J, H;
                if ((this.input = f = a.names[f && f.toLowerCase ? f.toLowerCase() : ""] || f) && f.stops) this.stops = f.stops.map(function (q) {
                    return new a(q[1])
                });
                else {
                    if (f && f.charAt && "#" === f.charAt()) {
                        var v = f.length;
                        f = parseInt(f.substr(1), 16);
                        7 === v ? J = [(f & 16711680) >> 16, (f & 65280) >> 8, f & 255, 1] : 4 === v && (J = [(f & 3840) >> 4 | (f & 3840) >> 8, (f & 240) >> 4 | f & 240, (f & 15) << 4 | f & 15, 1])
                    }
                    if (!J)
                        for (H = this.parsers.length; H-- && !J;) {
                            var L =
                                this.parsers[H];
                            (v = L.regex.exec(f)) && (J = L.parse(v))
                        }
                }
                this.rgba = J || []
            };
            a.prototype.get = function (a) {
                var f = this.input,
                    H = this.rgba;
                if ("undefined" !== typeof this.stops) {
                    var v = y(f);
                    v.stops = [].concat(v.stops);
                    this.stops.forEach(function (f, q) {
                        v.stops[q] = [v.stops[q][0], f.get(a)]
                    })
                } else v = H && S(H[0]) ? "rgb" === a || !a && 1 === H[3] ? "rgb(" + H[0] + "," + H[1] + "," + H[2] + ")" : "a" === a ? H[3] : "rgba(" + H.join(",") + ")" : f;
                return v
            };
            a.prototype.brighten = function (a) {
                var f, H = this.rgba;
                if (this.stops) this.stops.forEach(function (f) {
                    f.brighten(a)
                });
                else if (S(a) && 0 !== a)
                    for (f = 0; 3 > f; f++) H[f] += n(255 * a), 0 > H[f] && (H[f] = 0), 255 < H[f] && (H[f] = 255);
                return this
            };
            a.prototype.setOpacity = function (a) {
                this.rgba[3] = a;
                return this
            };
            a.prototype.tweenTo = function (a, f) {
                var H = this.rgba,
                    v = a.rgba;
                v.length && H && H.length ? (a = 1 !== v[3] || 1 !== H[3], f = (a ? "rgba(" : "rgb(") + Math.round(v[0] + (H[0] - v[0]) * (1 - f)) + "," + Math.round(v[1] + (H[1] - v[1]) * (1 - f)) + "," + Math.round(v[2] + (H[2] - v[2]) * (1 - f)) + (a ? "," + (v[3] + (H[3] - v[3]) * (1 - f)) : "") + ")") : f = a.input || "none";
                return f
            };
            a.names = {
                white: "#ffffff",
                black: "#000000"
            };
            return a
        }();
        f.Color = a;
        f.color = a.parse;
        return f.Color
    });
    O(n, "Core/Renderer/SVG/SVGElement.js", [n["Core/Color.js"], n["Core/Globals.js"], n["Core/Utilities.js"]], function (f, a, n) {
        var y = a.deg2rad,
            D = a.doc,
            G = a.hasTouch,
            C = a.isFirefox,
            J = a.noop,
            H = a.svg,
            v = a.SVG_NS,
            L = a.win,
            q = n.animate,
            K = n.animObject,
            E = n.attr,
            p = n.createElement,
            t = n.css,
            I = n.defined,
            u = n.erase,
            m = n.extend,
            h = n.fireEvent,
            l = n.isArray,
            k = n.isFunction,
            g = n.isNumber,
            d = n.isString,
            x = n.merge,
            r = n.objectEach,
            A = n.pick,
            N = n.pInt,
            B = n.stop,
            M = n.syncTimeout,
            R = n.uniqueKey;
        "";
        n = function () {
            function F() {
                this.height = this.element = void 0;
                this.opacity = 1;
                this.renderer = void 0;
                this.SVG_NS = v;
                this.symbolCustomAttribs = "x y width height r start end innerR anchorX anchorY rounded".split(" ");
                this.width = void 0
            }
            F.prototype._defaultGetter = function (e) {
                e = A(this[e + "Value"], this[e], this.element ? this.element.getAttribute(e) : null, 0);
                /^[\-0-9\.]+$/.test(e) && (e = parseFloat(e));
                return e
            };
            F.prototype._defaultSetter = function (e, c, b) {
                b.setAttribute(c, e)
            };
            F.prototype.add = function (e) {
                var c = this.renderer,
                    b = this.element;
                e && (this.parentGroup = e);
                this.parentInverted = e && e.inverted;
                "undefined" !== typeof this.textStr && "text" === this.element.nodeName && c.buildText(this);
                this.added = !0;
                if (!e || e.handleZ || this.zIndex) var d = this.zIndexSetter();
                d || (e ? e.element : c.box).appendChild(b);
                if (this.onAdd) this.onAdd();
                return this
            };
            F.prototype.addClass = function (e, c) {
                var b = c ? "" : this.attr("class") || "";
                e = (e || "").split(/ /g).reduce(function (c, e) {
                    -1 === b.indexOf(e) && c.push(e);
                    return c
                }, b ? [b] : []).join(" ");
                e !== b && this.attr("class",
                    e);
                return this
            };
            F.prototype.afterSetters = function () {
                this.doTransform && (this.updateTransform(), this.doTransform = !1)
            };
            F.prototype.align = function (e, c, b) {
                var z, w = {};
                var g = this.renderer;
                var h = g.alignedObjects;
                var k, l;
                if (e) {
                    if (this.alignOptions = e, this.alignByTranslate = c, !b || d(b)) this.alignTo = z = b || "renderer", u(h, this), h.push(this), b = void 0
                } else e = this.alignOptions, c = this.alignByTranslate, z = this.alignTo;
                b = A(b, g[z], g);
                z = e.align;
                g = e.verticalAlign;
                h = (b.x || 0) + (e.x || 0);
                var r = (b.y || 0) + (e.y || 0);
                "right" === z ? k = 1 :
                    "center" === z && (k = 2);
                k && (h += (b.width - (e.width || 0)) / k);
                w[c ? "translateX" : "x"] = Math.round(h);
                "bottom" === g ? l = 1 : "middle" === g && (l = 2);
                l && (r += (b.height - (e.height || 0)) / l);
                w[c ? "translateY" : "y"] = Math.round(r);
                this[this.placed ? "animate" : "attr"](w);
                this.placed = !0;
                this.alignAttr = w;
                return this
            };
            F.prototype.alignSetter = function (e) {
                var c = {
                    left: "start",
                    center: "middle",
                    right: "end"
                };
                c[e] && (this.alignValue = e, this.element.setAttribute("text-anchor", c[e]))
            };
            F.prototype.animate = function (e, c, b) {
                var d = this,
                    w = K(A(c, this.renderer.globalAnimation,
                        !0));
                c = w.defer;
                A(D.hidden, D.msHidden, D.webkitHidden, !1) && (w.duration = 0);
                0 !== w.duration ? (b && (w.complete = b), M(function () {
                    d.element && q(d, e, w)
                }, c)) : (this.attr(e, void 0, b), r(e, function (b, c) {
                    w.step && w.step.call(this, b, {
                        prop: c,
                        pos: 1
                    })
                }, this));
                return this
            };
            F.prototype.applyTextOutline = function (e) {
                var c = this.element,
                    b; - 1 !== e.indexOf("contrast") && (e = e.replace(/contrast/g, this.renderer.getContrast(c.style.fill)));
                e = e.split(" ");
                var d = e[e.length - 1];
                if ((b = e[0]) && "none" !== b && a.svg) {
                    this.fakeTS = !0;
                    e = [].slice.call(c.getElementsByTagName("tspan"));
                    this.ySetter = this.xSetter;
                    b = b.replace(/(^[\d\.]+)(.*?)$/g, function (b, c, e) {
                        return 2 * c + e
                    });
                    this.removeTextOutline(e);
                    var w = c.textContent ? /^[\u0591-\u065F\u066A-\u07FF\uFB1D-\uFDFD\uFE70-\uFEFC]/.test(c.textContent) : !1;
                    var g = c.firstChild;
                    e.forEach(function (e, z) {
                        0 === z && (e.setAttribute("x", c.getAttribute("x")), z = c.getAttribute("y"), e.setAttribute("y", z || 0), null === z && c.setAttribute("y", 0));
                        z = e.cloneNode(!0);
                        E(w && !C ? e : z, {
                            "class": "highcharts-text-outline",
                            fill: d,
                            stroke: d,
                            "stroke-width": b,
                            "stroke-linejoin": "round"
                        });
                        c.insertBefore(z, g)
                    });
                    w && C && e[0] && (e = e[0].cloneNode(!0), e.textContent = " ", c.insertBefore(e, g))
                }
            };
            F.prototype.attr = function (e, c, b, d) {
                var z = this.element,
                    g, h = this,
                    k, l, m = this.symbolCustomAttribs;
                if ("string" === typeof e && "undefined" !== typeof c) {
                    var x = e;
                    e = {};
                    e[x] = c
                }
                "string" === typeof e ? h = (this[e + "Getter"] || this._defaultGetter).call(this, e, z) : (r(e, function (b, c) {
                    k = !1;
                    d || B(this, c);
                    this.symbolName && -1 !== m.indexOf(c) && (g || (this.symbolAttr(e), g = !0), k = !0);
                    !this.rotation || "x" !== c && "y" !== c || (this.doTransform = !0);
                    k || (l = this[c + "Setter"] || this._defaultSetter, l.call(this, b, c, z), !this.styledMode && this.shadows && /^(width|height|visibility|x|y|d|transform|cx|cy|r)$/.test(c) && this.updateShadows(c, b, l))
                }, this), this.afterSetters());
                b && b.call(this);
                return h
            };
            F.prototype.clip = function (e) {
                return this.attr("clip-path", e ? "url(" + this.renderer.url + "#" + e.id + ")" : "none")
            };
            F.prototype.crisp = function (e, c) {
                c = c || e.strokeWidth || 0;
                var b = Math.round(c) % 2 / 2;
                e.x = Math.floor(e.x || this.x || 0) + b;
                e.y = Math.floor(e.y || this.y || 0) + b;
                e.width = Math.floor((e.width ||
                    this.width || 0) - 2 * b);
                e.height = Math.floor((e.height || this.height || 0) - 2 * b);
                I(e.strokeWidth) && (e.strokeWidth = c);
                return e
            };
            F.prototype.complexColor = function (e, c, b) {
                var d = this.renderer,
                    w, g, k, m, p, B, t, A, u, M, Q = [],
                    F;
                h(this.renderer, "complexColor", {
                    args: arguments
                }, function () {
                    e.radialGradient ? g = "radialGradient" : e.linearGradient && (g = "linearGradient");
                    if (g) {
                        k = e[g];
                        p = d.gradients;
                        B = e.stops;
                        u = b.radialReference;
                        l(k) && (e[g] = k = {
                            x1: k[0],
                            y1: k[1],
                            x2: k[2],
                            y2: k[3],
                            gradientUnits: "userSpaceOnUse"
                        });
                        "radialGradient" === g && u &&
                            !I(k.gradientUnits) && (m = k, k = x(k, d.getRadialAttr(u, m), {
                                gradientUnits: "userSpaceOnUse"
                            }));
                        r(k, function (b, c) {
                            "id" !== c && Q.push(c, b)
                        });
                        r(B, function (b) {
                            Q.push(b)
                        });
                        Q = Q.join(",");
                        if (p[Q]) M = p[Q].attr("id");
                        else {
                            k.id = M = R();
                            var z = p[Q] = d.createElement(g).attr(k).add(d.defs);
                            z.radAttr = m;
                            z.stops = [];
                            B.forEach(function (b) {
                                0 === b[1].indexOf("rgba") ? (w = f.parse(b[1]), t = w.get("rgb"), A = w.get("a")) : (t = b[1], A = 1);
                                b = d.createElement("stop").attr({
                                    offset: b[0],
                                    "stop-color": t,
                                    "stop-opacity": A
                                }).add(z);
                                z.stops.push(b)
                            })
                        }
                        F = "url(" +
                            d.url + "#" + M + ")";
                        b.setAttribute(c, F);
                        b.gradient = Q;
                        e.toString = function () {
                            return F
                        }
                    }
                })
            };
            F.prototype.css = function (e) {
                var c = this.styles,
                    b = {},
                    d = this.element,
                    w = "",
                    g = !c,
                    k = ["textOutline", "textOverflow", "width"];
                e && e.color && (e.fill = e.color);
                c && r(e, function (e, d) {
                    c && c[d] !== e && (b[d] = e, g = !0)
                });
                if (g) {
                    c && (e = m(c, b));
                    if (e)
                        if (null === e.width || "auto" === e.width) delete this.textWidth;
                        else if ("text" === d.nodeName.toLowerCase() && e.width) var h = this.textWidth = N(e.width);
                    this.styles = e;
                    h && !H && this.renderer.forExport && delete e.width;
                    if (d.namespaceURI === this.SVG_NS) {
                        var l = function (b, c) {
                            return "-" + c.toLowerCase()
                        };
                        r(e, function (b, c) {
                            -1 === k.indexOf(c) && (w += c.replace(/([A-Z])/g, l) + ":" + b + ";")
                        });
                        w && E(d, "style", w)
                    } else t(d, e);
                    this.added && ("text" === this.element.nodeName && this.renderer.buildText(this), e && e.textOutline && this.applyTextOutline(e.textOutline))
                }
                return this
            };
            F.prototype.dashstyleSetter = function (e) {
                var c = this["stroke-width"];
                "inherit" === c && (c = 1);
                if (e = e && e.toLowerCase()) {
                    var b = e.replace("shortdashdotdot", "3,1,1,1,1,1,").replace("shortdashdot",
                        "3,1,1,1").replace("shortdot", "1,1,").replace("shortdash", "3,1,").replace("longdash", "8,3,").replace(/dot/g, "1,3,").replace("dash", "4,3,").replace(/,$/, "").split(",");
                    for (e = b.length; e--;) b[e] = "" + N(b[e]) * A(c, NaN);
                    e = b.join(",").replace(/NaN/g, "none");
                    this.element.setAttribute("stroke-dasharray", e)
                }
            };
            F.prototype.destroy = function () {
                var e = this,
                    c = e.element || {},
                    b = e.renderer,
                    d = b.isSVG && "SPAN" === c.nodeName && e.parentGroup || void 0,
                    w = c.ownerSVGElement;
                c.onclick = c.onmouseout = c.onmouseover = c.onmousemove = c.point =
                    null;
                B(e);
                if (e.clipPath && w) {
                    var g = e.clipPath;
                    [].forEach.call(w.querySelectorAll("[clip-path],[CLIP-PATH]"), function (b) {
                        -1 < b.getAttribute("clip-path").indexOf(g.element.id) && b.removeAttribute("clip-path")
                    });
                    e.clipPath = g.destroy()
                }
                if (e.stops) {
                    for (w = 0; w < e.stops.length; w++) e.stops[w].destroy();
                    e.stops.length = 0;
                    e.stops = void 0
                }
                e.safeRemoveChild(c);
                for (b.styledMode || e.destroyShadows(); d && d.div && 0 === d.div.childNodes.length;) c = d.parentGroup, e.safeRemoveChild(d.div), delete d.div, d = c;
                e.alignTo && u(b.alignedObjects,
                    e);
                r(e, function (b, c) {
                    e[c] && e[c].parentGroup === e && e[c].destroy && e[c].destroy();
                    delete e[c]
                })
            };
            F.prototype.destroyShadows = function () {
                (this.shadows || []).forEach(function (e) {
                    this.safeRemoveChild(e)
                }, this);
                this.shadows = void 0
            };
            F.prototype.destroyTextPath = function (e, c) {
                var b = e.getElementsByTagName("text")[0];
                if (b) {
                    if (b.removeAttribute("dx"), b.removeAttribute("dy"), c.element.setAttribute("id", ""), this.textPathWrapper && b.getElementsByTagName("textPath").length) {
                        for (e = this.textPathWrapper.element.childNodes; e.length;) b.appendChild(e[0]);
                        b.removeChild(this.textPathWrapper.element)
                    }
                } else if (e.getAttribute("dx") || e.getAttribute("dy")) e.removeAttribute("dx"), e.removeAttribute("dy");
                this.textPathWrapper && (this.textPathWrapper = this.textPathWrapper.destroy())
            };
            F.prototype.dSetter = function (e, c, b) {
                l(e) && ("string" === typeof e[0] && (e = this.renderer.pathToSegments(e)), this.pathArray = e, e = e.reduce(function (b, c, e) {
                    return c && c.join ? (e ? b + " " : "") + c.join(" ") : (c || "").toString()
                }, ""));
                /(NaN| {2}|^$)/.test(e) && (e = "M 0 0");
                this[c] !== e && (b.setAttribute(c,
                    e), this[c] = e)
            };
            F.prototype.fadeOut = function (e) {
                var c = this;
                c.animate({
                    opacity: 0
                }, {
                    duration: A(e, 150),
                    complete: function () {
                        c.attr({
                            y: -9999
                        }).hide()
                    }
                })
            };
            F.prototype.fillSetter = function (e, c, b) {
                "string" === typeof e ? b.setAttribute(c, e) : e && this.complexColor(e, c, b)
            };
            F.prototype.getBBox = function (e, c) {
                var b, d = this.renderer,
                    w = this.element,
                    g = this.styles,
                    h = this.textStr,
                    l = d.cache,
                    r = d.cacheKeys,
                    x = w.namespaceURI === this.SVG_NS;
                c = A(c, this.rotation, 0);
                var p = d.styledMode ? w && F.prototype.getStyle.call(w, "font-size") : g && g.fontSize;
                if (I(h)) {
                    var B = h.toString(); - 1 === B.indexOf("<") && (B = B.replace(/[0-9]/g, "0"));
                    B += ["", c, p, this.textWidth, g && g.textOverflow, g && g.fontWeight].join()
                }
                B && !e && (b = l[B]);
                if (!b) {
                    if (x || d.forExport) {
                        try {
                            var t = this.fakeTS && function (b) {
                                [].forEach.call(w.querySelectorAll(".highcharts-text-outline"), function (c) {
                                    c.style.display = b
                                })
                            };
                            k(t) && t("none");
                            b = w.getBBox ? m({}, w.getBBox()) : {
                                width: w.offsetWidth,
                                height: w.offsetHeight
                            };
                            k(t) && t("")
                        } catch (V) {
                            ""
                        }
                        if (!b || 0 > b.width) b = {
                            width: 0,
                            height: 0
                        }
                    } else b = this.htmlGetBBox();
                    d.isSVG &&
                        (e = b.width, d = b.height, x && (b.height = d = {
                            "11px,17": 14,
                            "13px,20": 16
                        } [g && g.fontSize + "," + Math.round(d)] || d), c && (g = c * y, b.width = Math.abs(d * Math.sin(g)) + Math.abs(e * Math.cos(g)), b.height = Math.abs(d * Math.cos(g)) + Math.abs(e * Math.sin(g))));
                    if (B && 0 < b.height) {
                        for (; 250 < r.length;) delete l[r.shift()];
                        l[B] || r.push(B);
                        l[B] = b
                    }
                }
                return b
            };
            F.prototype.getStyle = function (e) {
                return L.getComputedStyle(this.element || this, "").getPropertyValue(e)
            };
            F.prototype.hasClass = function (e) {
                return -1 !== ("" + this.attr("class")).split(" ").indexOf(e)
            };
            F.prototype.hide = function (e) {
                e ? this.attr({
                    y: -9999
                }) : this.attr({
                    visibility: "hidden"
                });
                return this
            };
            F.prototype.htmlGetBBox = function () {
                return {
                    height: 0,
                    width: 0,
                    x: 0,
                    y: 0
                }
            };
            F.prototype.init = function (e, c) {
                this.element = "span" === c ? p(c) : D.createElementNS(this.SVG_NS, c);
                this.renderer = e;
                h(this, "afterInit")
            };
            F.prototype.invert = function (e) {
                this.inverted = e;
                this.updateTransform();
                return this
            };
            F.prototype.on = function (e, c) {
                var b, d, w = this.element,
                    g;
                G && "click" === e ? (w.ontouchstart = function (c) {
                    b = c.touches[0].clientX;
                    d =
                        c.touches[0].clientY
                }, w.ontouchend = function (e) {
                    b && 4 <= Math.sqrt(Math.pow(b - e.changedTouches[0].clientX, 2) + Math.pow(d - e.changedTouches[0].clientY, 2)) || c.call(w, e);
                    g = !0;
                    e.preventDefault()
                }, w.onclick = function (b) {
                    g || c.call(w, b)
                }) : w["on" + e] = c;
                return this
            };
            F.prototype.opacitySetter = function (e, c, b) {
                this[c] = e;
                b.setAttribute(c, e)
            };
            F.prototype.removeClass = function (e) {
                return this.attr("class", ("" + this.attr("class")).replace(d(e) ? new RegExp("(^| )" + e + "( |$)") : e, " ").replace(/ +/g, " ").trim())
            };
            F.prototype.removeTextOutline =
                function (e) {
                    for (var c = e.length, b; c--;) b = e[c], "highcharts-text-outline" === b.getAttribute("class") && u(e, this.element.removeChild(b))
                };
            F.prototype.safeRemoveChild = function (e) {
                var c = e.parentNode;
                c && c.removeChild(e)
            };
            F.prototype.setRadialReference = function (e) {
                var c = this.element.gradient && this.renderer.gradients[this.element.gradient];
                this.element.radialReference = e;
                c && c.radAttr && c.animate(this.renderer.getRadialAttr(e, c.radAttr));
                return this
            };
            F.prototype.setTextPath = function (e, c) {
                var b = this.element,
                    d = {
                        textAnchor: "text-anchor"
                    },
                    w = !1,
                    k = this.textPathWrapper,
                    h = !k;
                c = x(!0, {
                    enabled: !0,
                    attributes: {
                        dy: -5,
                        startOffset: "50%",
                        textAnchor: "middle"
                    }
                }, c);
                var l = c.attributes;
                if (e && c && c.enabled) {
                    k && null === k.element.parentNode ? (h = !0, k = k.destroy()) : k && this.removeTextOutline.call(k.parentGroup, [].slice.call(b.getElementsByTagName("tspan")));
                    this.options && this.options.padding && (l.dx = -this.options.padding);
                    k || (this.textPathWrapper = k = this.renderer.createElement("textPath"), w = !0);
                    var m = k.element;
                    (c = e.element.getAttribute("id")) || e.element.setAttribute("id",
                        c = R());
                    if (h)
                        for (e = b.getElementsByTagName("tspan"); e.length;) e[0].setAttribute("y", 0), g(l.dx) && e[0].setAttribute("x", -l.dx), m.appendChild(e[0]);
                    w && k && k.add({
                        element: this.text ? this.text.element : b
                    });
                    m.setAttributeNS("http://www.w3.org/1999/xlink", "href", this.renderer.url + "#" + c);
                    I(l.dy) && (m.parentNode.setAttribute("dy", l.dy), delete l.dy);
                    I(l.dx) && (m.parentNode.setAttribute("dx", l.dx), delete l.dx);
                    r(l, function (b, c) {
                        m.setAttribute(d[c] || c, b)
                    });
                    b.removeAttribute("transform");
                    this.removeTextOutline.call(k,
                        [].slice.call(b.getElementsByTagName("tspan")));
                    this.text && !this.renderer.styledMode && this.attr({
                        fill: "none",
                        "stroke-width": 0
                    });
                    this.applyTextOutline = this.updateTransform = J
                } else k && (delete this.updateTransform, delete this.applyTextOutline, this.destroyTextPath(b, e), this.updateTransform(), this.options && this.options.rotation && this.applyTextOutline(this.options.style.textOutline));
                return this
            };
            F.prototype.shadow = function (e, c, b) {
                var d = [],
                    g = this.element,
                    k = !1,
                    h = this.oldShadowOptions;
                var l = {
                    color: "#000000",
                    offsetX: 1,
                    offsetY: 1,
                    opacity: .15,
                    width: 3
                };
                var x;
                !0 === e ? x = l : "object" === typeof e && (x = m(l, e));
                x && (x && h && r(x, function (b, c) {
                    b !== h[c] && (k = !0)
                }), k && this.destroyShadows(), this.oldShadowOptions = x);
                if (!x) this.destroyShadows();
                else if (!this.shadows) {
                    var p = x.opacity / x.width;
                    var B = this.parentInverted ? "translate(-1,-1)" : "translate(" + x.offsetX + ", " + x.offsetY + ")";
                    for (l = 1; l <= x.width; l++) {
                        var t = g.cloneNode(!1);
                        var A = 2 * x.width + 1 - 2 * l;
                        E(t, {
                            stroke: e.color || "#000000",
                            "stroke-opacity": p * l,
                            "stroke-width": A,
                            transform: B,
                            fill: "none"
                        });
                        t.setAttribute("class", (t.getAttribute("class") || "") + " highcharts-shadow");
                        b && (E(t, "height", Math.max(E(t, "height") - A, 0)), t.cutHeight = A);
                        c ? c.element.appendChild(t) : g.parentNode && g.parentNode.insertBefore(t, g);
                        d.push(t)
                    }
                    this.shadows = d
                }
                return this
            };
            F.prototype.show = function (e) {
                return this.attr({
                    visibility: e ? "inherit" : "visible"
                })
            };
            F.prototype.strokeSetter = function (e, c, b) {
                this[c] = e;
                this.stroke && this["stroke-width"] ? (F.prototype.fillSetter.call(this, this.stroke, "stroke", b), b.setAttribute("stroke-width",
                    this["stroke-width"]), this.hasStroke = !0) : "stroke-width" === c && 0 === e && this.hasStroke ? (b.removeAttribute("stroke"), this.hasStroke = !1) : this.renderer.styledMode && this["stroke-width"] && (b.setAttribute("stroke-width", this["stroke-width"]), this.hasStroke = !0)
            };
            F.prototype.strokeWidth = function () {
                if (!this.renderer.styledMode) return this["stroke-width"] || 0;
                var e = this.getStyle("stroke-width"),
                    c = 0;
                if (e.indexOf("px") === e.length - 2) c = N(e);
                else if ("" !== e) {
                    var b = D.createElementNS(v, "rect");
                    E(b, {
                        width: e,
                        "stroke-width": 0
                    });
                    this.element.parentNode.appendChild(b);
                    c = b.getBBox().width;
                    b.parentNode.removeChild(b)
                }
                return c
            };
            F.prototype.symbolAttr = function (e) {
                var c = this;
                "x y r start end width height innerR anchorX anchorY clockwise".split(" ").forEach(function (b) {
                    c[b] = A(e[b], c[b])
                });
                c.attr({
                    d: c.renderer.symbols[c.symbolName](c.x, c.y, c.width, c.height, c)
                })
            };
            F.prototype.textSetter = function (e) {
                e !== this.textStr && (delete this.textPxLength, this.textStr = e, this.added && this.renderer.buildText(this))
            };
            F.prototype.titleSetter = function (e) {
                var c =
                    this.element.getElementsByTagName("title")[0];
                c || (c = D.createElementNS(this.SVG_NS, "title"), this.element.appendChild(c));
                c.firstChild && c.removeChild(c.firstChild);
                c.appendChild(D.createTextNode(String(A(e, "")).replace(/<[^>]*>/g, "").replace(/&lt;/g, "<").replace(/&gt;/g, ">")))
            };
            F.prototype.toFront = function () {
                var e = this.element;
                e.parentNode.appendChild(e);
                return this
            };
            F.prototype.translate = function (e, c) {
                return this.attr({
                    translateX: e,
                    translateY: c
                })
            };
            F.prototype.updateShadows = function (e, c, b) {
                var d = this.shadows;
                if (d)
                    for (var g = d.length; g--;) b.call(d[g], "height" === e ? Math.max(c - (d[g].cutHeight || 0), 0) : "d" === e ? this.d : c, e, d[g])
            };
            F.prototype.updateTransform = function () {
                var e = this.translateX || 0,
                    c = this.translateY || 0,
                    b = this.scaleX,
                    d = this.scaleY,
                    g = this.inverted,
                    k = this.rotation,
                    h = this.matrix,
                    l = this.element;
                g && (e += this.width, c += this.height);
                e = ["translate(" + e + "," + c + ")"];
                I(h) && e.push("matrix(" + h.join(",") + ")");
                g ? e.push("rotate(90) scale(-1,1)") : k && e.push("rotate(" + k + " " + A(this.rotationOriginX, l.getAttribute("x"), 0) + " " +
                    A(this.rotationOriginY, l.getAttribute("y") || 0) + ")");
                (I(b) || I(d)) && e.push("scale(" + A(b, 1) + " " + A(d, 1) + ")");
                e.length && l.setAttribute("transform", e.join(" "))
            };
            F.prototype.visibilitySetter = function (e, c, b) {
                "inherit" === e ? b.removeAttribute(c) : this[c] !== e && b.setAttribute(c, e);
                this[c] = e
            };
            F.prototype.xGetter = function (e) {
                "circle" === this.element.nodeName && ("x" === e ? e = "cx" : "y" === e && (e = "cy"));
                return this._defaultGetter(e)
            };
            F.prototype.zIndexSetter = function (e, c) {
                var b = this.renderer,
                    d = this.parentGroup,
                    g = (d || b).element ||
                    b.box,
                    k = this.element,
                    h = !1;
                b = g === b.box;
                var l = this.added;
                var r;
                I(e) ? (k.setAttribute("data-z-index", e), e = +e, this[c] === e && (l = !1)) : I(this[c]) && k.removeAttribute("data-z-index");
                this[c] = e;
                if (l) {
                    (e = this.zIndex) && d && (d.handleZ = !0);
                    c = g.childNodes;
                    for (r = c.length - 1; 0 <= r && !h; r--) {
                        d = c[r];
                        l = d.getAttribute("data-z-index");
                        var m = !I(l);
                        if (d !== k)
                            if (0 > e && m && !b && !r) g.insertBefore(k, c[r]), h = !0;
                            else if (N(l) <= e || m && (!I(e) || 0 <= e)) g.insertBefore(k, c[r + 1] || null), h = !0
                    }
                    h || (g.insertBefore(k, c[b ? 3 : 0] || null), h = !0)
                }
                return h
            };
            return F
        }();
        n.prototype["stroke-widthSetter"] = n.prototype.strokeSetter;
        n.prototype.yGetter = n.prototype.xGetter;
        n.prototype.matrixSetter = n.prototype.rotationOriginXSetter = n.prototype.rotationOriginYSetter = n.prototype.rotationSetter = n.prototype.scaleXSetter = n.prototype.scaleYSetter = n.prototype.translateXSetter = n.prototype.translateYSetter = n.prototype.verticalAlignSetter = function (d, e) {
            this[e] = d;
            this.doTransform = !0
        };
        a.SVGElement = n;
        return a.SVGElement
    });
    O(n, "Core/Renderer/SVG/SVGLabel.js", [n["Core/Renderer/SVG/SVGElement.js"],
        n["Core/Utilities.js"]
    ], function (f, a) {
        var n = this && this.__extends || function () {
                var a = function (f, L) {
                    a = Object.setPrototypeOf || {
                        __proto__: []
                    }
                    instanceof Array && function (a, f) {
                        a.__proto__ = f
                    } || function (a, f) {
                        for (var q in f) f.hasOwnProperty(q) && (a[q] = f[q])
                    };
                    return a(f, L)
                };
                return function (f, L) {
                    function q() {
                        this.constructor = f
                    }
                    a(f, L);
                    f.prototype = null === L ? Object.create(L) : (q.prototype = L.prototype, new q)
                }
            }(),
            y = a.defined,
            D = a.extend,
            G = a.isNumber,
            C = a.merge,
            J = a.removeEvent;
        return function (a) {
            function v(f, q, H, E, p, t, I,
                u, m, h) {
                var l = a.call(this) || this;
                l.init(f, "g");
                l.textStr = q;
                l.x = H;
                l.y = E;
                l.anchorX = t;
                l.anchorY = I;
                l.baseline = m;
                l.className = h;
                "button" !== h && l.addClass("highcharts-label");
                h && l.addClass("highcharts-" + h);
                l.text = f.text("", 0, 0, u).attr({
                    zIndex: 1
                });
                if ("string" === typeof p) {
                    var k = /^url\((.*?)\)$/.test(p);
                    if (l.renderer.symbols[p] || k) l.symbolKey = p
                }
                l.bBox = v.emptyBBox;
                l.padding = 3;
                l.paddingLeft = 0;
                l.baselineOffset = 0;
                l.needsBox = f.styledMode || k;
                l.deferredAttr = {};
                l.alignFactor = 0;
                return l
            }
            n(v, a);
            v.prototype.alignSetter =
                function (a) {
                    a = {
                        left: 0,
                        center: .5,
                        right: 1
                    } [a];
                    a !== this.alignFactor && (this.alignFactor = a, this.bBox && G(this.xSetting) && this.attr({
                        x: this.xSetting
                    }))
                };
            v.prototype.anchorXSetter = function (a, f) {
                this.anchorX = a;
                this.boxAttr(f, Math.round(a) - this.getCrispAdjust() - this.xSetting)
            };
            v.prototype.anchorYSetter = function (a, f) {
                this.anchorY = a;
                this.boxAttr(f, a - this.ySetting)
            };
            v.prototype.boxAttr = function (a, f) {
                this.box ? this.box.attr(a, f) : this.deferredAttr[a] = f
            };
            v.prototype.css = function (a) {
                if (a) {
                    var q = {};
                    a = C(a);
                    v.textProps.forEach(function (f) {
                        "undefined" !==
                        typeof a[f] && (q[f] = a[f], delete a[f])
                    });
                    this.text.css(q);
                    var L = "fontSize" in q || "fontWeight" in q;
                    if ("width" in q || L) this.updateBoxSize(), L && this.updateTextPadding()
                }
                return f.prototype.css.call(this, a)
            };
            v.prototype.destroy = function () {
                J(this.element, "mouseenter");
                J(this.element, "mouseleave");
                this.text && this.text.destroy();
                this.box && (this.box = this.box.destroy());
                f.prototype.destroy.call(this)
            };
            v.prototype.fillSetter = function (a, f) {
                a && (this.needsBox = !0);
                this.fill = a;
                this.boxAttr(f, a)
            };
            v.prototype.getBBox =
                function () {
                    var a = this.bBox,
                        f = this.padding;
                    return {
                        width: a.width + 2 * f,
                        height: a.height + 2 * f,
                        x: a.x - f,
                        y: a.y - f
                    }
                };
            v.prototype.getCrispAdjust = function () {
                return this.renderer.styledMode && this.box ? this.box.strokeWidth() % 2 / 2 : (this["stroke-width"] ? parseInt(this["stroke-width"], 10) : 0) % 2 / 2
            };
            v.prototype.heightSetter = function (a) {
                this.heightSetting = a
            };
            v.prototype.on = function (a, q) {
                var v = this,
                    E = v.text,
                    p = E && "SPAN" === E.element.tagName ? E : void 0;
                if (p) {
                    var t = function (t) {
                        ("mouseenter" === a || "mouseleave" === a) && t.relatedTarget instanceof
                        Element && (v.element.contains(t.relatedTarget) || p.element.contains(t.relatedTarget)) || q.call(v.element, t)
                    };
                    p.on(a, t)
                }
                f.prototype.on.call(v, a, t || q);
                return v
            };
            v.prototype.onAdd = function () {
                var a = this.textStr;
                this.text.add(this);
                this.attr({
                    text: y(a) ? a : "",
                    x: this.x,
                    y: this.y
                });
                this.box && y(this.anchorX) && this.attr({
                    anchorX: this.anchorX,
                    anchorY: this.anchorY
                })
            };
            v.prototype.paddingSetter = function (a) {
                y(a) && a !== this.padding && (this.padding = a, this.updateTextPadding())
            };
            v.prototype.paddingLeftSetter = function (a) {
                y(a) &&
                    a !== this.paddingLeft && (this.paddingLeft = a, this.updateTextPadding())
            };
            v.prototype.rSetter = function (a, f) {
                this.boxAttr(f, a)
            };
            v.prototype.shadow = function (a) {
                a && !this.renderer.styledMode && (this.updateBoxSize(), this.box && this.box.shadow(a));
                return this
            };
            v.prototype.strokeSetter = function (a, f) {
                this.stroke = a;
                this.boxAttr(f, a)
            };
            v.prototype["stroke-widthSetter"] = function (a, f) {
                a && (this.needsBox = !0);
                this["stroke-width"] = a;
                this.boxAttr(f, a)
            };
            v.prototype["text-alignSetter"] = function (a) {
                this.textAlign = a
            };
            v.prototype.textSetter =
                function (a) {
                    "undefined" !== typeof a && this.text.attr({
                        text: a
                    });
                    this.updateBoxSize();
                    this.updateTextPadding()
                };
            v.prototype.updateBoxSize = function () {
                var a = this.text.element.style,
                    f = {},
                    H = this.padding,
                    E = this.paddingLeft,
                    p = G(this.widthSetting) && G(this.heightSetting) && !this.textAlign || !y(this.text.textStr) ? v.emptyBBox : this.text.getBBox();
                this.width = (this.widthSetting || p.width || 0) + 2 * H + E;
                this.height = (this.heightSetting || p.height || 0) + 2 * H;
                this.baselineOffset = H + Math.min(this.renderer.fontMetrics(a && a.fontSize,
                    this.text).b, p.height || Infinity);
                this.needsBox && (this.box || (a = this.box = this.symbolKey ? this.renderer.symbol(this.symbolKey) : this.renderer.rect(), a.addClass(("button" === this.className ? "" : "highcharts-label-box") + (this.className ? " highcharts-" + this.className + "-box" : "")), a.add(this), a = this.getCrispAdjust(), f.x = a, f.y = (this.baseline ? -this.baselineOffset : 0) + a), f.width = Math.round(this.width), f.height = Math.round(this.height), this.box.attr(D(f, this.deferredAttr)), this.deferredAttr = {});
                this.bBox = p
            };
            v.prototype.updateTextPadding =
                function () {
                    var a = this.text,
                        f = this.baseline ? 0 : this.baselineOffset,
                        v = this.paddingLeft + this.padding;
                    y(this.widthSetting) && this.bBox && ("center" === this.textAlign || "right" === this.textAlign) && (v += {
                        center: .5,
                        right: 1
                    } [this.textAlign] * (this.widthSetting - this.bBox.width));
                    if (v !== a.x || f !== a.y) a.attr("x", v), a.hasBoxWidthChanged && (this.bBox = a.getBBox(!0), this.updateBoxSize()), "undefined" !== typeof f && a.attr("y", f);
                    a.x = v;
                    a.y = f
                };
            v.prototype.widthSetter = function (a) {
                this.widthSetting = G(a) ? a : void 0
            };
            v.prototype.xSetter =
                function (a) {
                    this.x = a;
                    this.alignFactor && (a -= this.alignFactor * ((this.widthSetting || this.bBox.width) + 2 * this.padding), this["forceAnimate:x"] = !0);
                    this.xSetting = Math.round(a);
                    this.attr("translateX", this.xSetting)
                };
            v.prototype.ySetter = function (a) {
                this.ySetting = this.y = Math.round(a);
                this.attr("translateY", this.ySetting)
            };
            v.emptyBBox = {
                width: 0,
                height: 0,
                x: 0,
                y: 0
            };
            v.textProps = "color cursor direction fontFamily fontSize fontStyle fontWeight lineHeight textAlign textDecoration textOutline textOverflow width".split(" ");
            return v
        }(f)
    });
    O(n, "Core/Renderer/SVG/SVGRenderer.js", [n["Core/Color.js"], n["Core/Globals.js"], n["Core/Renderer/SVG/SVGElement.js"], n["Core/Renderer/SVG/SVGLabel.js"], n["Core/Utilities.js"]], function (f, a, n, y, D) {
        var G = D.addEvent,
            C = D.attr,
            J = D.createElement,
            H = D.css,
            v = D.defined,
            L = D.destroyObjectProperties,
            q = D.extend,
            K = D.isArray,
            E = D.isNumber,
            p = D.isObject,
            t = D.isString,
            I = D.merge,
            u = D.objectEach,
            m = D.pick,
            h = D.pInt,
            l = D.splat,
            k = D.uniqueKey,
            g = a.charts,
            d = a.deg2rad,
            x = a.doc,
            r = a.isFirefox,
            A = a.isMS,
            N = a.isWebKit;
        D =
            a.noop;
        var B = a.svg,
            M = a.SVG_NS,
            R = a.symbolSizes,
            F = a.win,
            e = function () {
                function c(b, c, e, d, g, k, h) {
                    this.width = this.url = this.style = this.isSVG = this.imgCount = this.height = this.gradients = this.globalAnimation = this.defs = this.chartIndex = this.cacheKeys = this.cache = this.boxWrapper = this.box = this.alignedObjects = void 0;
                    this.init(b, c, e, d, g, k, h)
                }
                c.prototype.init = function (b, c, e, d, g, k, h) {
                    var w = this.createElement("svg").attr({
                        version: "1.1",
                        "class": "highcharts-root"
                    });
                    h || w.css(this.getStyle(d));
                    d = w.element;
                    b.appendChild(d);
                    C(b, "dir", "ltr"); - 1 === b.innerHTML.indexOf("xmlns") && C(d, "xmlns", this.SVG_NS);
                    this.isSVG = !0;
                    this.box = d;
                    this.boxWrapper = w;
                    this.alignedObjects = [];
                    this.url = (r || N) && x.getElementsByTagName("base").length ? F.location.href.split("#")[0].replace(/<[^>]*>/g, "").replace(/([\('\)])/g, "\\$1").replace(/ /g, "%20") : "";
                    this.createElement("desc").add().element.appendChild(x.createTextNode("Created with Highcharts 8.2.0"));
                    this.defs = this.createElement("defs").add();
                    this.allowHTML = k;
                    this.forExport = g;
                    this.styledMode = h;
                    this.gradients = {};
                    this.cache = {};
                    this.cacheKeys = [];
                    this.imgCount = 0;
                    this.setSize(c, e, !1);
                    var z;
                    r && b.getBoundingClientRect && (c = function () {
                        H(b, {
                            left: 0,
                            top: 0
                        });
                        z = b.getBoundingClientRect();
                        H(b, {
                            left: Math.ceil(z.left) - z.left + "px",
                            top: Math.ceil(z.top) - z.top + "px"
                        })
                    }, c(), this.unSubPixelFix = G(F, "resize", c))
                };
                c.prototype.definition = function (b) {
                    function c(b, d) {
                        var g;
                        l(b).forEach(function (b) {
                            var w = e.createElement(b.tagName),
                                z = {};
                            u(b, function (b, c) {
                                "tagName" !== c && "children" !== c && "textContent" !== c && (z[c] = b)
                            });
                            w.attr(z);
                            w.add(d || e.defs);
                            b.textContent && w.element.appendChild(x.createTextNode(b.textContent));
                            c(b.children || [], w);
                            g = w
                        });
                        return g
                    }
                    var e = this;
                    return c(b)
                };
                c.prototype.getStyle = function (b) {
                    return this.style = q({
                        fontFamily: '"Lucida Grande", "Lucida Sans Unicode", Arial, Helvetica, sans-serif',
                        fontSize: "12px"
                    }, b)
                };
                c.prototype.setStyle = function (b) {
                    this.boxWrapper.css(this.getStyle(b))
                };
                c.prototype.isHidden = function () {
                    return !this.boxWrapper.getBBox().width
                };
                c.prototype.destroy = function () {
                    var b = this.defs;
                    this.box =
                        null;
                    this.boxWrapper = this.boxWrapper.destroy();
                    L(this.gradients || {});
                    this.gradients = null;
                    b && (this.defs = b.destroy());
                    this.unSubPixelFix && this.unSubPixelFix();
                    return this.alignedObjects = null
                };
                c.prototype.createElement = function (b) {
                    var c = new this.Element;
                    c.init(this, b);
                    return c
                };
                c.prototype.getRadialAttr = function (b, c) {
                    return {
                        cx: b[0] - b[2] / 2 + c.cx * b[2],
                        cy: b[1] - b[2] / 2 + c.cy * b[2],
                        r: c.r * b[2]
                    }
                };
                c.prototype.truncate = function (b, c, e, d, g, k, h) {
                    var w = this,
                        z = b.rotation,
                        l, r = d ? 1 : 0,
                        m = (e || d).length,
                        P = m,
                        p = [],
                        t = function (b) {
                            c.firstChild &&
                                c.removeChild(c.firstChild);
                            b && c.appendChild(x.createTextNode(b))
                        },
                        B = function (z, k) {
                            k = k || z;
                            if ("undefined" === typeof p[k])
                                if (c.getSubStringLength) try {
                                    p[k] = g + c.getSubStringLength(0, d ? k + 1 : k)
                                } catch (da) {
                                    ""
                                } else w.getSpanWidth && (t(h(e || d, z)), p[k] = g + w.getSpanWidth(b, c));
                            return p[k]
                        },
                        a;
                    b.rotation = 0;
                    var A = B(c.textContent.length);
                    if (a = g + A > k) {
                        for (; r <= m;) P = Math.ceil((r + m) / 2), d && (l = h(d, P)), A = B(P, l && l.length - 1), r === m ? r = m + 1 : A > k ? m = P - 1 : r = P;
                        0 === m ? t("") : e && m === e.length - 1 || t(l || h(e || d, P))
                    }
                    d && d.splice(0, P);
                    b.actualWidth =
                        A;
                    b.rotation = z;
                    return a
                };
                c.prototype.buildText = function (b) {
                    var c = b.element,
                        e = this,
                        d = e.forExport,
                        g = m(b.textStr, "").toString(),
                        k = -1 !== g.indexOf("<"),
                        l = c.childNodes,
                        r, p = C(c, "x"),
                        a = b.styles,
                        A = b.textWidth,
                        I = a && a.lineHeight,
                        Q = a && a.textOutline,
                        f = a && "ellipsis" === a.textOverflow,
                        F = a && "nowrap" === a.whiteSpace,
                        N = a && a.fontSize,
                        q, E = l.length;
                    a = A && !b.added && this.box;
                    var v = function (b) {
                            var d;
                            e.styledMode || (d = /(px|em)$/.test(b && b.style.fontSize) ? b.style.fontSize : N || e.style.fontSize || 12);
                            return I ? h(I) : e.fontMetrics(d,
                                b.getAttribute("style") ? b : c).h
                        },
                        R = function (b, c) {
                            u(e.escapes, function (e, d) {
                                c && -1 !== c.indexOf(e) || (b = b.toString().replace(new RegExp(e, "g"), d))
                            });
                            return b
                        },
                        n = function (b, c) {
                            var e = b.indexOf("<");
                            b = b.substring(e, b.indexOf(">") - e);
                            e = b.indexOf(c + "=");
                            if (-1 !== e && (e = e + c.length + 1, c = b.charAt(e), '"' === c || "'" === c)) return b = b.substring(e + 1), b.substring(0, b.indexOf(c))
                        },
                        K = /<br.*?>/g;
                    var J = [g, f, F, I, Q, N, A].join();
                    if (J !== b.textCache) {
                        for (b.textCache = J; E--;) c.removeChild(l[E]);
                        k || Q || f || A || -1 !== g.indexOf(" ") && (!F ||
                            K.test(g)) ? (a && a.appendChild(c), k ? (g = e.styledMode ? g.replace(/<(b|strong)>/g, '<span class="highcharts-strong">').replace(/<(i|em)>/g, '<span class="highcharts-emphasized">') : g.replace(/<(b|strong)>/g, '<span style="font-weight:bold">').replace(/<(i|em)>/g, '<span style="font-style:italic">'), g = g.replace(/<a/g, "<span").replace(/<\/(b|strong|i|em|a)>/g, "</span>").split(K)) : g = [g], g = g.filter(function (b) {
                            return "" !== b
                        }), g.forEach(function (g, w) {
                            var k = 0,
                                z = 0;
                            g = g.replace(/^\s+|\s+$/g, "").replace(/<span/g, "|||<span").replace(/<\/span>/g,
                                "</span>|||");
                            var h = g.split("|||");
                            h.forEach(function (g) {
                                if ("" !== g || 1 === h.length) {
                                    var l = {},
                                        m = x.createElementNS(e.SVG_NS, "tspan"),
                                        P, a;
                                    (P = n(g, "class")) && C(m, "class", P);
                                    if (P = n(g, "style")) P = P.replace(/(;| |^)color([ :])/, "$1fill$2"), C(m, "style", P);
                                    if ((a = n(g, "href")) && !d && -1 === a.split(":")[0].toLowerCase().indexOf("javascript")) {
                                        var t = x.createElementNS(e.SVG_NS, "a");
                                        C(t, "href", a);
                                        C(m, "class", "highcharts-anchor");
                                        t.appendChild(m);
                                        e.styledMode || H(m, {
                                            cursor: "pointer"
                                        })
                                    }
                                    g = R(g.replace(/<[a-zA-Z\/](.|\n)*?>/g,
                                        "") || " ");
                                    if (" " !== g) {
                                        m.appendChild(x.createTextNode(g));
                                        k ? l.dx = 0 : w && null !== p && (l.x = p);
                                        C(m, l);
                                        c.appendChild(t || m);
                                        !k && q && (!B && d && H(m, {
                                            display: "block"
                                        }), C(m, "dy", v(m)));
                                        if (A) {
                                            var Q = g.replace(/([^\^])-/g, "$1- ").split(" ");
                                            l = !F && (1 < h.length || w || 1 < Q.length);
                                            t = 0;
                                            a = v(m);
                                            if (f) r = e.truncate(b, m, g, void 0, 0, Math.max(0, A - parseInt(N || 12, 10)), function (b, c) {
                                                return b.substring(0, c) + "\u2026"
                                            });
                                            else if (l)
                                                for (; Q.length;) Q.length && !F && 0 < t && (m = x.createElementNS(M, "tspan"), C(m, {
                                                    dy: a,
                                                    x: p
                                                }), P && C(m, "style", P), m.appendChild(x.createTextNode(Q.join(" ").replace(/- /g,
                                                    "-"))), c.appendChild(m)), e.truncate(b, m, null, Q, 0 === t ? z : 0, A, function (b, c) {
                                                    return Q.slice(0, c).join(" ").replace(/- /g, "-")
                                                }), z = b.actualWidth, t++
                                        }
                                        k++
                                    }
                                }
                            });
                            q = q || c.childNodes.length
                        }), f && r && b.attr("title", R(b.textStr || "", ["&lt;", "&gt;"])), a && a.removeChild(c), t(Q) && b.applyTextOutline && b.applyTextOutline(Q)) : c.appendChild(x.createTextNode(R(g)))
                    }
                };
                c.prototype.getContrast = function (b) {
                    b = f.parse(b).rgba;
                    b[0] *= 1;
                    b[1] *= 1.2;
                    b[2] *= .5;
                    return 459 < b[0] + b[1] + b[2] ? "#000000" : "#FFFFFF"
                };
                c.prototype.button = function (b,
                    c, e, d, g, k, h, l, r, m) {
                    var w = this.label(b, c, e, r, void 0, void 0, m, void 0, "button"),
                        z = 0,
                        x = this.styledMode;
                    b = (g = g ? I(g) : g) && g.style || {};
                    g && g.style && delete g.style;
                    w.attr(I({
                        padding: 8,
                        r: 2
                    }, g));
                    if (!x) {
                        g = I({
                            fill: "#f7f7f7",
                            stroke: "#cccccc",
                            "stroke-width": 1,
                            style: {
                                color: "#333333",
                                cursor: "pointer",
                                fontWeight: "normal"
                            }
                        }, {
                            style: b
                        }, g);
                        var P = g.style;
                        delete g.style;
                        k = I(g, {
                            fill: "#e6e6e6"
                        }, k);
                        var t = k.style;
                        delete k.style;
                        h = I(g, {
                            fill: "#e6ebf5",
                            style: {
                                color: "#000000",
                                fontWeight: "bold"
                            }
                        }, h);
                        var a = h.style;
                        delete h.style;
                        l =
                            I(g, {
                                style: {
                                    color: "#cccccc"
                                }
                            }, l);
                        var p = l.style;
                        delete l.style
                    }
                    G(w.element, A ? "mouseover" : "mouseenter", function () {
                        3 !== z && w.setState(1)
                    });
                    G(w.element, A ? "mouseout" : "mouseleave", function () {
                        3 !== z && w.setState(z)
                    });
                    w.setState = function (b) {
                        1 !== b && (w.state = z = b);
                        w.removeClass(/highcharts-button-(normal|hover|pressed|disabled)/).addClass("highcharts-button-" + ["normal", "hover", "pressed", "disabled"][b || 0]);
                        x || w.attr([g, k, h, l][b || 0]).css([P, t, a, p][b || 0])
                    };
                    x || w.attr(g).css(q({
                        cursor: "default"
                    }, P));
                    return w.on("click",
                        function (b) {
                            3 !== z && d.call(w, b)
                        })
                };
                c.prototype.crispLine = function (b, c, e) {
                    void 0 === e && (e = "round");
                    var d = b[0],
                        g = b[1];
                    d[1] === g[1] && (d[1] = g[1] = Math[e](d[1]) - c % 2 / 2);
                    d[2] === g[2] && (d[2] = g[2] = Math[e](d[2]) + c % 2 / 2);
                    return b
                };
                c.prototype.path = function (b) {
                    var c = this.styledMode ? {} : {
                        fill: "none"
                    };
                    K(b) ? c.d = b : p(b) && q(c, b);
                    return this.createElement("path").attr(c)
                };
                c.prototype.circle = function (b, c, e) {
                    b = p(b) ? b : "undefined" === typeof b ? {} : {
                        x: b,
                        y: c,
                        r: e
                    };
                    c = this.createElement("circle");
                    c.xSetter = c.ySetter = function (b, c, e) {
                        e.setAttribute("c" +
                            c, b)
                    };
                    return c.attr(b)
                };
                c.prototype.arc = function (b, c, e, d, g, k) {
                    p(b) ? (d = b, c = d.y, e = d.r, b = d.x) : d = {
                        innerR: d,
                        start: g,
                        end: k
                    };
                    b = this.symbol("arc", b, c, e, e, d);
                    b.r = e;
                    return b
                };
                c.prototype.rect = function (b, c, e, d, g, k) {
                    g = p(b) ? b.r : g;
                    var w = this.createElement("rect");
                    b = p(b) ? b : "undefined" === typeof b ? {} : {
                        x: b,
                        y: c,
                        width: Math.max(e, 0),
                        height: Math.max(d, 0)
                    };
                    this.styledMode || ("undefined" !== typeof k && (b.strokeWidth = k, b = w.crisp(b)), b.fill = "none");
                    g && (b.r = g);
                    w.rSetter = function (b, c, e) {
                        w.r = b;
                        C(e, {
                            rx: b,
                            ry: b
                        })
                    };
                    w.rGetter = function () {
                        return w.r
                    };
                    return w.attr(b)
                };
                c.prototype.setSize = function (b, c, e) {
                    var d = this.alignedObjects,
                        g = d.length;
                    this.width = b;
                    this.height = c;
                    for (this.boxWrapper.animate({
                            width: b,
                            height: c
                        }, {
                            step: function () {
                                this.attr({
                                    viewBox: "0 0 " + this.attr("width") + " " + this.attr("height")
                                })
                            },
                            duration: m(e, !0) ? void 0 : 0
                        }); g--;) d[g].align()
                };
                c.prototype.g = function (b) {
                    var c = this.createElement("g");
                    return b ? c.attr({
                        "class": "highcharts-" + b
                    }) : c
                };
                c.prototype.image = function (b, c, e, d, g, k) {
                    var w = {
                            preserveAspectRatio: "none"
                        },
                        h = function (b, c) {
                            b.setAttributeNS ?
                                b.setAttributeNS("http://www.w3.org/1999/xlink", "href", c) : b.setAttribute("hc-svg-href", c)
                        },
                        z = function (c) {
                            h(l.element, b);
                            k.call(l, c)
                        };
                    1 < arguments.length && q(w, {
                        x: c,
                        y: e,
                        width: d,
                        height: g
                    });
                    var l = this.createElement("image").attr(w);
                    k ? (h(l.element, "data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw=="), w = new F.Image, G(w, "load", z), w.src = b, w.complete && z({})) : h(l.element, b);
                    return l
                };
                c.prototype.symbol = function (b, c, e, d, k, h) {
                    var w = this,
                        z = /^url\((.*?)\)$/,
                        l = z.test(b),
                        r = !l && (this.symbols[b] ?
                            b : "circle"),
                        P = r && this.symbols[r],
                        t;
                    if (P) {
                        "number" === typeof c && (t = P.call(this.symbols, Math.round(c || 0), Math.round(e || 0), d || 0, k || 0, h));
                        var a = this.path(t);
                        w.styledMode || a.attr("fill", "none");
                        q(a, {
                            symbolName: r,
                            x: c,
                            y: e,
                            width: d,
                            height: k
                        });
                        h && q(a, h)
                    } else if (l) {
                        var p = b.match(z)[1];
                        a = this.image(p);
                        a.imgwidth = m(R[p] && R[p].width, h && h.width);
                        a.imgheight = m(R[p] && R[p].height, h && h.height);
                        var B = function () {
                            a.attr({
                                width: a.width,
                                height: a.height
                            })
                        };
                        ["width", "height"].forEach(function (b) {
                            a[b + "Setter"] = function (b, c) {
                                var e = {},
                                    d = this["img" + c],
                                    g = "width" === c ? "translateX" : "translateY";
                                this[c] = b;
                                v(d) && (h && "within" === h.backgroundSize && this.width && this.height && (d = Math.round(d * Math.min(this.width / this.imgwidth, this.height / this.imgheight))), this.element && this.element.setAttribute(c, d), this.alignByTranslate || (e[g] = ((this[c] || 0) - d) / 2, this.attr(e)))
                            }
                        });
                        v(c) && a.attr({
                            x: c,
                            y: e
                        });
                        a.isImg = !0;
                        v(a.imgwidth) && v(a.imgheight) ? B() : (a.attr({
                            width: 0,
                            height: 0
                        }), J("img", {
                            onload: function () {
                                var b = g[w.chartIndex];
                                0 === this.width && (H(this, {
                                    position: "absolute",
                                    top: "-999em"
                                }), x.body.appendChild(this));
                                R[p] = {
                                    width: this.width,
                                    height: this.height
                                };
                                a.imgwidth = this.width;
                                a.imgheight = this.height;
                                a.element && B();
                                this.parentNode && this.parentNode.removeChild(this);
                                w.imgCount--;
                                if (!w.imgCount && b && !b.hasLoaded) b.onload()
                            },
                            src: p
                        }), this.imgCount++)
                    }
                    return a
                };
                c.prototype.clipRect = function (b, c, e, d) {
                    var g = k() + "-",
                        w = this.createElement("clipPath").attr({
                            id: g
                        }).add(this.defs);
                    b = this.rect(b, c, e, d, 0).add(w);
                    b.id = g;
                    b.clipPath = w;
                    b.count = 0;
                    return b
                };
                c.prototype.text = function (b, c,
                    e, d) {
                    var g = {};
                    if (d && (this.allowHTML || !this.forExport)) return this.html(b, c, e);
                    g.x = Math.round(c || 0);
                    e && (g.y = Math.round(e));
                    v(b) && (g.text = b);
                    b = this.createElement("text").attr(g);
                    d || (b.xSetter = function (b, c, e) {
                        var d = e.getElementsByTagName("tspan"),
                            g = e.getAttribute(c),
                            k;
                        for (k = 0; k < d.length; k++) {
                            var w = d[k];
                            w.getAttribute(c) === g && w.setAttribute(c, b)
                        }
                        e.setAttribute(c, b)
                    });
                    return b
                };
                c.prototype.fontMetrics = function (b, c) {
                    b = !this.styledMode && /px/.test(b) || !F.getComputedStyle ? b || c && c.style && c.style.fontSize ||
                        this.style && this.style.fontSize : c && n.prototype.getStyle.call(c, "font-size");
                    b = /px/.test(b) ? h(b) : 12;
                    c = 24 > b ? b + 3 : Math.round(1.2 * b);
                    return {
                        h: c,
                        b: Math.round(.8 * c),
                        f: b
                    }
                };
                c.prototype.rotCorr = function (b, c, e) {
                    var g = b;
                    c && e && (g = Math.max(g * Math.cos(c * d), 4));
                    return {
                        x: -b / 3 * Math.sin(c * d),
                        y: g
                    }
                };
                c.prototype.pathToSegments = function (b) {
                    for (var c = [], e = [], d = {
                            A: 8,
                            C: 7,
                            H: 2,
                            L: 3,
                            M: 3,
                            Q: 5,
                            S: 5,
                            T: 3,
                            V: 2
                        }, g = 0; g < b.length; g++) t(e[0]) && E(b[g]) && e.length === d[e[0].toUpperCase()] && b.splice(g, 0, e[0].replace("M", "L").replace("m", "l")),
                        "string" === typeof b[g] && (e.length && c.push(e.slice(0)), e.length = 0), e.push(b[g]);
                    c.push(e.slice(0));
                    return c
                };
                c.prototype.label = function (b, c, e, d, g, k, h, l, r) {
                    return new y(this, b, c, e, d, g, k, h, l, r)
                };
                return c
            }();
        e.prototype.Element = n;
        e.prototype.SVG_NS = M;
        e.prototype.draw = D;
        e.prototype.escapes = {
            "&": "&amp;",
            "<": "&lt;",
            ">": "&gt;",
            "'": "&#39;",
            '"': "&quot;"
        };
        e.prototype.symbols = {
            circle: function (c, b, e, d) {
                return this.arc(c + e / 2, b + d / 2, e / 2, d / 2, {
                    start: .5 * Math.PI,
                    end: 2.5 * Math.PI,
                    open: !1
                })
            },
            square: function (c, b, e, d) {
                return [
                    ["M",
                        c, b
                    ],
                    ["L", c + e, b],
                    ["L", c + e, b + d],
                    ["L", c, b + d],
                    ["Z"]
                ]
            },
            triangle: function (c, b, e, d) {
                return [
                    ["M", c + e / 2, b],
                    ["L", c + e, b + d],
                    ["L", c, b + d],
                    ["Z"]
                ]
            },
            "triangle-down": function (c, b, e, d) {
                return [
                    ["M", c, b],
                    ["L", c + e, b],
                    ["L", c + e / 2, b + d],
                    ["Z"]
                ]
            },
            diamond: function (c, b, e, d) {
                return [
                    ["M", c + e / 2, b],
                    ["L", c + e, b + d / 2],
                    ["L", c + e / 2, b + d],
                    ["L", c, b + d / 2],
                    ["Z"]
                ]
            },
            arc: function (c, b, e, d, g) {
                var k = [];
                if (g) {
                    var h = g.start || 0,
                        w = g.end || 0,
                        z = g.r || e;
                    e = g.r || d || e;
                    var l = .001 > Math.abs(w - h - 2 * Math.PI);
                    w -= .001;
                    d = g.innerR;
                    l = m(g.open, l);
                    var r = Math.cos(h),
                        x = Math.sin(h),
                        a = Math.cos(w),
                        P = Math.sin(w);
                    h = m(g.longArc, .001 > w - h - Math.PI ? 0 : 1);
                    k.push(["M", c + z * r, b + e * x], ["A", z, e, 0, h, m(g.clockwise, 1), c + z * a, b + e * P]);
                    v(d) && k.push(l ? ["M", c + d * a, b + d * P] : ["L", c + d * a, b + d * P], ["A", d, d, 0, h, v(g.clockwise) ? 1 - g.clockwise : 0, c + d * r, b + d * x]);
                    l || k.push(["Z"])
                }
                return k
            },
            callout: function (c, b, e, d, g) {
                var k = Math.min(g && g.r || 0, e, d),
                    h = k + 6,
                    w = g && g.anchorX || 0;
                g = g && g.anchorY || 0;
                var l = [
                    ["M", c + k, b],
                    ["L", c + e - k, b],
                    ["C", c + e, b, c + e, b, c + e, b + k],
                    ["L", c + e, b + d - k],
                    ["C", c + e, b + d, c + e, b + d, c + e - k, b + d],
                    ["L", c + k, b + d],
                    ["C", c, b + d,
                        c, b + d, c, b + d - k
                    ],
                    ["L", c, b + k],
                    ["C", c, b, c, b, c + k, b]
                ];
                w && w > e ? g > b + h && g < b + d - h ? l.splice(3, 1, ["L", c + e, g - 6], ["L", c + e + 6, g], ["L", c + e, g + 6], ["L", c + e, b + d - k]) : l.splice(3, 1, ["L", c + e, d / 2], ["L", w, g], ["L", c + e, d / 2], ["L", c + e, b + d - k]) : w && 0 > w ? g > b + h && g < b + d - h ? l.splice(7, 1, ["L", c, g + 6], ["L", c - 6, g], ["L", c, g - 6], ["L", c, b + k]) : l.splice(7, 1, ["L", c, d / 2], ["L", w, g], ["L", c, d / 2], ["L", c, b + k]) : g && g > d && w > c + h && w < c + e - h ? l.splice(5, 1, ["L", w + 6, b + d], ["L", w, b + d + 6], ["L", w - 6, b + d], ["L", c + k, b + d]) : g && 0 > g && w > c + h && w < c + e - h && l.splice(1, 1, ["L", w - 6, b], ["L",
                    w, b - 6
                ], ["L", w + 6, b], ["L", e - k, b]);
                return l
            }
        };
        a.SVGRenderer = e;
        a.Renderer = a.SVGRenderer;
        return a.Renderer
    });
    O(n, "Core/Renderer/HTML/HTML.js", [n["Core/Globals.js"], n["Core/Renderer/SVG/SVGElement.js"], n["Core/Renderer/SVG/SVGRenderer.js"], n["Core/Utilities.js"]], function (f, a, n, y) {
        var D = y.attr,
            G = y.createElement,
            C = y.css,
            J = y.defined,
            H = y.extend,
            v = y.pick,
            L = y.pInt,
            q = f.isFirefox,
            K = f.isMS,
            E = f.isWebKit,
            p = f.win;
        H(a.prototype, {
            htmlCss: function (a) {
                var p = "SPAN" === this.element.tagName && a && "width" in a,
                    t = v(p && a.width,
                        void 0);
                if (p) {
                    delete a.width;
                    this.textWidth = t;
                    var m = !0
                }
                a && "ellipsis" === a.textOverflow && (a.whiteSpace = "nowrap", a.overflow = "hidden");
                this.styles = H(this.styles, a);
                C(this.element, a);
                m && this.htmlUpdateTransform();
                return this
            },
            htmlGetBBox: function () {
                var a = this.element;
                return {
                    x: a.offsetLeft,
                    y: a.offsetTop,
                    width: a.offsetWidth,
                    height: a.offsetHeight
                }
            },
            htmlUpdateTransform: function () {
                if (this.added) {
                    var a = this.renderer,
                        p = this.element,
                        u = this.translateX || 0,
                        m = this.translateY || 0,
                        h = this.x || 0,
                        l = this.y || 0,
                        k = this.textAlign ||
                        "left",
                        g = {
                            left: 0,
                            center: .5,
                            right: 1
                        } [k],
                        d = this.styles,
                        x = d && d.whiteSpace;
                    C(p, {
                        marginLeft: u,
                        marginTop: m
                    });
                    !a.styledMode && this.shadows && this.shadows.forEach(function (d) {
                        C(d, {
                            marginLeft: u + 1,
                            marginTop: m + 1
                        })
                    });
                    this.inverted && [].forEach.call(p.childNodes, function (d) {
                        a.invertChild(d, p)
                    });
                    if ("SPAN" === p.tagName) {
                        d = this.rotation;
                        var r = this.textWidth && L(this.textWidth),
                            A = [d, k, p.innerHTML, this.textWidth, this.textAlign].join(),
                            f;
                        (f = r !== this.oldTextWidth) && !(f = r > this.oldTextWidth) && ((f = this.textPxLength) || (C(p, {
                            width: "",
                            whiteSpace: x || "nowrap"
                        }), f = p.offsetWidth), f = f > r);
                        f && (/[ \-]/.test(p.textContent || p.innerText) || "ellipsis" === p.style.textOverflow) ? (C(p, {
                            width: r + "px",
                            display: "block",
                            whiteSpace: x || "normal"
                        }), this.oldTextWidth = r, this.hasBoxWidthChanged = !0) : this.hasBoxWidthChanged = !1;
                        A !== this.cTT && (x = a.fontMetrics(p.style.fontSize, p).b, !J(d) || d === (this.oldRotation || 0) && k === this.oldAlign || this.setSpanRotation(d, g, x), this.getSpanCorrection(!J(d) && this.textPxLength || p.offsetWidth, x, g, d, k));
                        C(p, {
                            left: h + (this.xCorr || 0) + "px",
                            top: l + (this.yCorr || 0) + "px"
                        });
                        this.cTT = A;
                        this.oldRotation = d;
                        this.oldAlign = k
                    }
                } else this.alignOnAdd = !0
            },
            setSpanRotation: function (a, p, u) {
                var m = {},
                    h = this.renderer.getTransformKey();
                m[h] = m.transform = "rotate(" + a + "deg)";
                m[h + (q ? "Origin" : "-origin")] = m.transformOrigin = 100 * p + "% " + u + "px";
                C(this.element, m)
            },
            getSpanCorrection: function (a, p, u) {
                this.xCorr = -a * u;
                this.yCorr = -p
            }
        });
        H(n.prototype, {
            getTransformKey: function () {
                return K && !/Edge/.test(p.navigator.userAgent) ? "-ms-transform" : E ? "-webkit-transform" : q ? "MozTransform" :
                    p.opera ? "-o-transform" : ""
            },
            html: function (p, f, u) {
                var m = this.createElement("span"),
                    h = m.element,
                    l = m.renderer,
                    k = l.isSVG,
                    g = function (d, g) {
                        ["opacity", "visibility"].forEach(function (k) {
                            d[k + "Setter"] = function (h, l, r) {
                                var m = d.div ? d.div.style : g;
                                a.prototype[k + "Setter"].call(this, h, l, r);
                                m && (m[l] = h)
                            }
                        });
                        d.addedSetters = !0
                    };
                m.textSetter = function (d) {
                    d !== h.innerHTML && (delete this.bBox, delete this.oldTextWidth);
                    this.textStr = d;
                    h.innerHTML = v(d, "");
                    m.doTransform = !0
                };
                k && g(m, m.element.style);
                m.xSetter = m.ySetter = m.alignSetter =
                    m.rotationSetter = function (d, g) {
                        "align" === g ? m.alignValue = m.textAlign = d : m[g] = d;
                        m.doTransform = !0
                    };
                m.afterSetters = function () {
                    this.doTransform && (this.htmlUpdateTransform(), this.doTransform = !1)
                };
                m.attr({
                    text: p,
                    x: Math.round(f),
                    y: Math.round(u)
                }).css({
                    position: "absolute"
                });
                l.styledMode || m.css({
                    fontFamily: this.style.fontFamily,
                    fontSize: this.style.fontSize
                });
                h.style.whiteSpace = "nowrap";
                m.css = m.htmlCss;
                k && (m.add = function (d) {
                    var k = l.box.parentNode,
                        r = [];
                    if (this.parentGroup = d) {
                        var a = d.div;
                        if (!a) {
                            for (; d;) r.push(d),
                                d = d.parentGroup;
                            r.reverse().forEach(function (d) {
                                function h(g, e) {
                                    d[e] = g;
                                    "translateX" === e ? x.left = g + "px" : x.top = g + "px";
                                    d.doTransform = !0
                                }
                                var l = D(d.element, "class");
                                a = d.div = d.div || G("div", l ? {
                                    className: l
                                } : void 0, {
                                    position: "absolute",
                                    left: (d.translateX || 0) + "px",
                                    top: (d.translateY || 0) + "px",
                                    display: d.display,
                                    opacity: d.opacity,
                                    pointerEvents: d.styles && d.styles.pointerEvents
                                }, a || k);
                                var x = a.style;
                                H(d, {
                                    classSetter: function (d) {
                                        return function (e) {
                                            this.element.setAttribute("class", e);
                                            d.className = e
                                        }
                                    }(a),
                                    on: function () {
                                        r[0].div &&
                                            m.on.apply({
                                                element: r[0].div
                                            }, arguments);
                                        return d
                                    },
                                    translateXSetter: h,
                                    translateYSetter: h
                                });
                                d.addedSetters || g(d)
                            })
                        }
                    } else a = k;
                    a.appendChild(h);
                    m.added = !0;
                    m.alignOnAdd && m.htmlUpdateTransform();
                    return m
                });
                return m
            }
        })
    });
    O(n, "Core/Axis/Tick.js", [n["Core/Globals.js"], n["Core/Utilities.js"]], function (f, a) {
        var n = a.clamp,
            y = a.correctFloat,
            D = a.defined,
            G = a.destroyObjectProperties,
            C = a.extend,
            J = a.fireEvent,
            H = a.isNumber,
            v = a.merge,
            L = a.objectEach,
            q = a.pick,
            K = f.deg2rad;
        a = function () {
            function a(a, t, f, u, m) {
                this.isNewLabel =
                    this.isNew = !0;
                this.axis = a;
                this.pos = t;
                this.type = f || "";
                this.parameters = m || {};
                this.tickmarkOffset = this.parameters.tickmarkOffset;
                this.options = this.parameters.options;
                J(this, "init");
                f || u || this.addLabel()
            }
            a.prototype.addLabel = function () {
                var a = this,
                    t = a.axis,
                    f = t.options,
                    u = t.chart,
                    m = t.categories,
                    h = t.logarithmic,
                    l = t.names,
                    k = a.pos,
                    g = q(a.options && a.options.labels, f.labels),
                    d = t.tickPositions,
                    x = k === d[0],
                    r = k === d[d.length - 1];
                l = this.parameters.category || (m ? q(m[k], l[k], k) : k);
                var A = a.label;
                m = (!g.step || 1 === g.step) &&
                    1 === t.tickInterval;
                d = d.info;
                var N, B;
                if (t.dateTime && d) {
                    var M = u.time.resolveDTLFormat(f.dateTimeLabelFormats[!f.grid && d.higherRanks[k] || d.unitName]);
                    var v = M.main
                }
                a.isFirst = x;
                a.isLast = r;
                a.formatCtx = {
                    axis: t,
                    chart: u,
                    isFirst: x,
                    isLast: r,
                    dateTimeLabelFormat: v,
                    tickPositionInfo: d,
                    value: h ? y(h.lin2log(l)) : l,
                    pos: k
                };
                f = t.labelFormatter.call(a.formatCtx, this.formatCtx);
                if (B = M && M.list) a.shortenLabel = function () {
                    for (N = 0; N < B.length; N++)
                        if (A.attr({
                                text: t.labelFormatter.call(C(a.formatCtx, {
                                    dateTimeLabelFormat: B[N]
                                }))
                            }),
                            A.getBBox().width < t.getSlotWidth(a) - 2 * q(g.padding, 5)) return;
                    A.attr({
                        text: ""
                    })
                };
                m && t._addedPlotLB && a.moveLabel(f, g);
                D(A) || a.movedLabel ? A && A.textStr !== f && !m && (!A.textWidth || g.style && g.style.width || A.styles.width || A.css({
                    width: null
                }), A.attr({
                    text: f
                }), A.textPxLength = A.getBBox().width) : (a.label = A = a.createLabel({
                    x: 0,
                    y: 0
                }, f, g), a.rotation = 0)
            };
            a.prototype.createLabel = function (a, t, f) {
                var p = this.axis,
                    m = p.chart;
                if (a = D(t) && f.enabled ? m.renderer.text(t, a.x, a.y, f.useHTML).add(p.labelGroup) : null) m.styledMode || a.css(v(f.style)),
                    a.textPxLength = a.getBBox().width;
                return a
            };
            a.prototype.destroy = function () {
                G(this, this.axis)
            };
            a.prototype.getPosition = function (a, t, f, u) {
                var m = this.axis,
                    h = m.chart,
                    l = u && h.oldChartHeight || h.chartHeight;
                a = {
                    x: a ? y(m.translate(t + f, null, null, u) + m.transB) : m.left + m.offset + (m.opposite ? (u && h.oldChartWidth || h.chartWidth) - m.right - m.left : 0),
                    y: a ? l - m.bottom + m.offset - (m.opposite ? m.height : 0) : y(l - m.translate(t + f, null, null, u) - m.transB)
                };
                a.y = n(a.y, -1E5, 1E5);
                J(this, "afterGetPosition", {
                    pos: a
                });
                return a
            };
            a.prototype.getLabelPosition =
                function (a, t, f, u, m, h, l, k) {
                    var g = this.axis,
                        d = g.transA,
                        x = g.isLinked && g.linkedParent ? g.linkedParent.reversed : g.reversed,
                        r = g.staggerLines,
                        p = g.tickRotCorr || {
                            x: 0,
                            y: 0
                        },
                        I = m.y,
                        B = u || g.reserveSpaceDefault ? 0 : -g.labelOffset * ("center" === g.labelAlign ? .5 : 1),
                        M = {};
                    D(I) || (I = 0 === g.side ? f.rotation ? -8 : -f.getBBox().height : 2 === g.side ? p.y + 8 : Math.cos(f.rotation * K) * (p.y - f.getBBox(!1, 0).height / 2));
                    a = a + m.x + B + p.x - (h && u ? h * d * (x ? -1 : 1) : 0);
                    t = t + I - (h && !u ? h * d * (x ? 1 : -1) : 0);
                    r && (f = l / (k || 1) % r, g.opposite && (f = r - f - 1), t += g.labelOffset / r * f);
                    M.x =
                        a;
                    M.y = Math.round(t);
                    J(this, "afterGetLabelPosition", {
                        pos: M,
                        tickmarkOffset: h,
                        index: l
                    });
                    return M
                };
            a.prototype.getLabelSize = function () {
                return this.label ? this.label.getBBox()[this.axis.horiz ? "height" : "width"] : 0
            };
            a.prototype.getMarkPath = function (a, t, f, u, m, h) {
                return h.crispLine([
                    ["M", a, t],
                    ["L", a + (m ? 0 : -f), t + (m ? f : 0)]
                ], u)
            };
            a.prototype.handleOverflow = function (a) {
                var p = this.axis,
                    f = p.options.labels,
                    u = a.x,
                    m = p.chart.chartWidth,
                    h = p.chart.spacing,
                    l = q(p.labelLeft, Math.min(p.pos, h[3]));
                h = q(p.labelRight, Math.max(p.isRadial ?
                    0 : p.pos + p.len, m - h[1]));
                var k = this.label,
                    g = this.rotation,
                    d = {
                        left: 0,
                        center: .5,
                        right: 1
                    } [p.labelAlign || k.attr("align")],
                    x = k.getBBox().width,
                    r = p.getSlotWidth(this),
                    A = r,
                    N = 1,
                    B, M = {};
                if (g || "justify" !== q(f.overflow, "justify")) 0 > g && u - d * x < l ? B = Math.round(u / Math.cos(g * K) - l) : 0 < g && u + d * x > h && (B = Math.round((m - u) / Math.cos(g * K)));
                else if (m = u + (1 - d) * x, u - d * x < l ? A = a.x + A * (1 - d) - l : m > h && (A = h - a.x + A * d, N = -1), A = Math.min(r, A), A < r && "center" === p.labelAlign && (a.x += N * (r - A - d * (r - Math.min(x, A)))), x > A || p.autoRotation && (k.styles || {}).width) B =
                    A;
                B && (this.shortenLabel ? this.shortenLabel() : (M.width = Math.floor(B) + "px", (f.style || {}).textOverflow || (M.textOverflow = "ellipsis"), k.css(M)))
            };
            a.prototype.moveLabel = function (a, t) {
                var p = this,
                    f = p.label,
                    m = !1,
                    h = p.axis,
                    l = h.reversed;
                f && f.textStr === a ? (p.movedLabel = f, m = !0, delete p.label) : L(h.ticks, function (g) {
                    m || g.isNew || g === p || !g.label || g.label.textStr !== a || (p.movedLabel = g.label, m = !0, g.labelPos = p.movedLabel.xy, delete g.label)
                });
                if (!m && (p.labelPos || f)) {
                    var k = p.labelPos || f.xy;
                    f = h.horiz ? l ? 0 : h.width + h.left : k.x;
                    h = h.horiz ? k.y : l ? h.width + h.left : 0;
                    p.movedLabel = p.createLabel({
                        x: f,
                        y: h
                    }, a, t);
                    p.movedLabel && p.movedLabel.attr({
                        opacity: 0
                    })
                }
            };
            a.prototype.render = function (a, t, f) {
                var p = this.axis,
                    m = p.horiz,
                    h = this.pos,
                    l = q(this.tickmarkOffset, p.tickmarkOffset);
                h = this.getPosition(m, h, l, t);
                l = h.x;
                var k = h.y;
                p = m && l === p.pos + p.len || !m && k === p.pos ? -1 : 1;
                f = q(f, 1);
                this.isActive = !0;
                this.renderGridLine(t, f, p);
                this.renderMark(h, f, p);
                this.renderLabel(h, t, f, a);
                this.isNew = !1;
                J(this, "afterRender")
            };
            a.prototype.renderGridLine = function (a, t, f) {
                var p =
                    this.axis,
                    m = p.options,
                    h = this.gridLine,
                    l = {},
                    k = this.pos,
                    g = this.type,
                    d = q(this.tickmarkOffset, p.tickmarkOffset),
                    x = p.chart.renderer,
                    r = g ? g + "Grid" : "grid",
                    A = m[r + "LineWidth"],
                    N = m[r + "LineColor"];
                m = m[r + "LineDashStyle"];
                h || (p.chart.styledMode || (l.stroke = N, l["stroke-width"] = A, m && (l.dashstyle = m)), g || (l.zIndex = 1), a && (t = 0), this.gridLine = h = x.path().attr(l).addClass("highcharts-" + (g ? g + "-" : "") + "grid-line").add(p.gridGroup));
                if (h && (f = p.getPlotLinePath({
                        value: k + d,
                        lineWidth: h.strokeWidth() * f,
                        force: "pass",
                        old: a
                    }))) h[a ||
                    this.isNew ? "attr" : "animate"]({
                    d: f,
                    opacity: t
                })
            };
            a.prototype.renderMark = function (a, t, f) {
                var p = this.axis,
                    m = p.options,
                    h = p.chart.renderer,
                    l = this.type,
                    k = l ? l + "Tick" : "tick",
                    g = p.tickSize(k),
                    d = this.mark,
                    x = !d,
                    r = a.x;
                a = a.y;
                var A = q(m[k + "Width"], !l && p.isXAxis ? 1 : 0);
                m = m[k + "Color"];
                g && (p.opposite && (g[0] = -g[0]), x && (this.mark = d = h.path().addClass("highcharts-" + (l ? l + "-" : "") + "tick").add(p.axisGroup), p.chart.styledMode || d.attr({
                    stroke: m,
                    "stroke-width": A
                })), d[x ? "attr" : "animate"]({
                    d: this.getMarkPath(r, a, g[0], d.strokeWidth() *
                        f, p.horiz, h),
                    opacity: t
                }))
            };
            a.prototype.renderLabel = function (a, f, I, u) {
                var m = this.axis,
                    h = m.horiz,
                    l = m.options,
                    k = this.label,
                    g = l.labels,
                    d = g.step;
                m = q(this.tickmarkOffset, m.tickmarkOffset);
                var x = !0,
                    r = a.x;
                a = a.y;
                k && H(r) && (k.xy = a = this.getLabelPosition(r, a, k, h, g, m, u, d), this.isFirst && !this.isLast && !q(l.showFirstLabel, 1) || this.isLast && !this.isFirst && !q(l.showLastLabel, 1) ? x = !1 : !h || g.step || g.rotation || f || 0 === I || this.handleOverflow(a), d && u % d && (x = !1), x && H(a.y) ? (a.opacity = I, k[this.isNewLabel ? "attr" : "animate"](a), this.isNewLabel = !1) : (k.attr("y", -9999), this.isNewLabel = !0))
            };
            a.prototype.replaceMovedLabel = function () {
                var a = this.label,
                    f = this.axis,
                    q = f.reversed;
                if (a && !this.isNew) {
                    var u = f.horiz ? q ? f.left : f.width + f.left : a.xy.x;
                    q = f.horiz ? a.xy.y : q ? f.width + f.top : f.top;
                    a.animate({
                        x: u,
                        y: q,
                        opacity: 0
                    }, void 0, a.destroy);
                    delete this.label
                }
                f.isDirty = !0;
                this.label = this.movedLabel;
                delete this.movedLabel
            };
            return a
        }();
        f.Tick = a;
        return f.Tick
    });
    O(n, "Core/Time.js", [n["Core/Globals.js"], n["Core/Utilities.js"]], function (f, a) {
        var n = a.defined,
            y = a.error,
            D = a.extend,
            G = a.isObject,
            C = a.merge,
            J = a.objectEach,
            H = a.pad,
            v = a.pick,
            L = a.splat,
            q = a.timeUnits,
            K = f.win;
        a = function () {
            function a(a) {
                this.options = {};
                this.variableTimezone = this.useUTC = !1;
                this.Date = K.Date;
                this.getTimezoneOffset = this.timezoneOffsetFunction();
                this.update(a)
            }
            a.prototype.get = function (a, f) {
                if (this.variableTimezone || this.timezoneOffset) {
                    var p = f.getTime(),
                        t = p - this.getTimezoneOffset(f);
                    f.setTime(t);
                    a = f["getUTC" + a]();
                    f.setTime(p);
                    return a
                }
                return this.useUTC ? f["getUTC" + a]() : f["get" + a]()
            };
            a.prototype.set =
                function (a, f, q) {
                    if (this.variableTimezone || this.timezoneOffset) {
                        if ("Milliseconds" === a || "Seconds" === a || "Minutes" === a) return f["setUTC" + a](q);
                        var p = this.getTimezoneOffset(f);
                        p = f.getTime() - p;
                        f.setTime(p);
                        f["setUTC" + a](q);
                        a = this.getTimezoneOffset(f);
                        p = f.getTime() + a;
                        return f.setTime(p)
                    }
                    return this.useUTC ? f["setUTC" + a](q) : f["set" + a](q)
                };
            a.prototype.update = function (a) {
                var f = v(a && a.useUTC, !0);
                this.options = a = C(!0, this.options || {}, a);
                this.Date = a.Date || K.Date || Date;
                this.timezoneOffset = (this.useUTC = f) && a.timezoneOffset;
                this.getTimezoneOffset = this.timezoneOffsetFunction();
                this.variableTimezone = !(f && !a.getTimezoneOffset && !a.timezone)
            };
            a.prototype.makeTime = function (a, t, q, u, m, h) {
                if (this.useUTC) {
                    var l = this.Date.UTC.apply(0, arguments);
                    var k = this.getTimezoneOffset(l);
                    l += k;
                    var g = this.getTimezoneOffset(l);
                    k !== g ? l += g - k : k - 36E5 !== this.getTimezoneOffset(l - 36E5) || f.isSafari || (l -= 36E5)
                } else l = (new this.Date(a, t, v(q, 1), v(u, 0), v(m, 0), v(h, 0))).getTime();
                return l
            };
            a.prototype.timezoneOffsetFunction = function () {
                var a = this,
                    f = this.options,
                    q = f.moment || K.moment;
                if (!this.useUTC) return function (a) {
                    return 6E4 * (new Date(a.toString())).getTimezoneOffset()
                };
                if (f.timezone) {
                    if (q) return function (a) {
                        return 6E4 * -q.tz(a, f.timezone).utcOffset()
                    };
                    y(25)
                }
                return this.useUTC && f.getTimezoneOffset ? function (a) {
                    return 6E4 * f.getTimezoneOffset(a.valueOf())
                } : function () {
                    return 6E4 * (a.timezoneOffset || 0)
                }
            };
            a.prototype.dateFormat = function (a, t, q) {
                var p;
                if (!n(t) || isNaN(t)) return (null === (p = f.defaultOptions.lang) || void 0 === p ? void 0 : p.invalidDate) || "";
                a = v(a, "%Y-%m-%d %H:%M:%S");
                var m = this;
                p = new this.Date(t);
                var h = this.get("Hours", p),
                    l = this.get("Day", p),
                    k = this.get("Date", p),
                    g = this.get("Month", p),
                    d = this.get("FullYear", p),
                    x = f.defaultOptions.lang,
                    r = null === x || void 0 === x ? void 0 : x.weekdays,
                    A = null === x || void 0 === x ? void 0 : x.shortWeekdays;
                p = D({
                    a: A ? A[l] : r[l].substr(0, 3),
                    A: r[l],
                    d: H(k),
                    e: H(k, 2, " "),
                    w: l,
                    b: x.shortMonths[g],
                    B: x.months[g],
                    m: H(g + 1),
                    o: g + 1,
                    y: d.toString().substr(2, 2),
                    Y: d,
                    H: H(h),
                    k: h,
                    I: H(h % 12 || 12),
                    l: h % 12 || 12,
                    M: H(this.get("Minutes", p)),
                    p: 12 > h ? "AM" : "PM",
                    P: 12 > h ? "am" : "pm",
                    S: H(p.getSeconds()),
                    L: H(Math.floor(t % 1E3), 3)
                }, f.dateFormats);
                J(p, function (d, g) {
                    for (; - 1 !== a.indexOf("%" + g);) a = a.replace("%" + g, "function" === typeof d ? d.call(m, t) : d)
                });
                return q ? a.substr(0, 1).toUpperCase() + a.substr(1) : a
            };
            a.prototype.resolveDTLFormat = function (a) {
                return G(a, !0) ? a : (a = L(a), {
                    main: a[0],
                    from: a[1],
                    to: a[2]
                })
            };
            a.prototype.getTimeTicks = function (a, f, I, u) {
                var m = this,
                    h = [],
                    l = {};
                var k = new m.Date(f);
                var g = a.unitRange,
                    d = a.count || 1,
                    x;
                u = v(u, 1);
                if (n(f)) {
                    m.set("Milliseconds", k, g >= q.second ? 0 : d * Math.floor(m.get("Milliseconds", k) /
                        d));
                    g >= q.second && m.set("Seconds", k, g >= q.minute ? 0 : d * Math.floor(m.get("Seconds", k) / d));
                    g >= q.minute && m.set("Minutes", k, g >= q.hour ? 0 : d * Math.floor(m.get("Minutes", k) / d));
                    g >= q.hour && m.set("Hours", k, g >= q.day ? 0 : d * Math.floor(m.get("Hours", k) / d));
                    g >= q.day && m.set("Date", k, g >= q.month ? 1 : Math.max(1, d * Math.floor(m.get("Date", k) / d)));
                    if (g >= q.month) {
                        m.set("Month", k, g >= q.year ? 0 : d * Math.floor(m.get("Month", k) / d));
                        var r = m.get("FullYear", k)
                    }
                    g >= q.year && m.set("FullYear", k, r - r % d);
                    g === q.week && (r = m.get("Day", k), m.set("Date",
                        k, m.get("Date", k) - r + u + (r < u ? -7 : 0)));
                    r = m.get("FullYear", k);
                    u = m.get("Month", k);
                    var p = m.get("Date", k),
                        t = m.get("Hours", k);
                    f = k.getTime();
                    m.variableTimezone && (x = I - f > 4 * q.month || m.getTimezoneOffset(f) !== m.getTimezoneOffset(I));
                    f = k.getTime();
                    for (k = 1; f < I;) h.push(f), f = g === q.year ? m.makeTime(r + k * d, 0) : g === q.month ? m.makeTime(r, u + k * d) : !x || g !== q.day && g !== q.week ? x && g === q.hour && 1 < d ? m.makeTime(r, u, p, t + k * d) : f + g * d : m.makeTime(r, u, p + k * d * (g === q.day ? 1 : 7)), k++;
                    h.push(f);
                    g <= q.hour && 1E4 > h.length && h.forEach(function (d) {
                        0 === d % 18E5 &&
                            "000000000" === m.dateFormat("%H%M%S%L", d) && (l[d] = "day")
                    })
                }
                h.info = D(a, {
                    higherRanks: l,
                    totalRange: g * d
                });
                return h
            };
            return a
        }();
        f.Time = a;
        return f.Time
    });
    O(n, "Core/Options.js", [n["Core/Globals.js"], n["Core/Time.js"], n["Core/Color.js"], n["Core/Utilities.js"]], function (f, a, n, y) {
        n = n.parse;
        y = y.merge;
        f.defaultOptions = {
            colors: "#7cb5ec #434348 #90ed7d #f7a35c #8085e9 #f15c80 #e4d354 #2b908f #f45b5b #91e8e1".split(" "),
            symbols: ["circle", "diamond", "square", "triangle", "triangle-down"],
            lang: {
                loading: "Loading...",
                months: "January February March April May June July August September October November December".split(" "),
                shortMonths: "Jan Feb Mar Apr May Jun Jul Aug Sep Oct Nov Dec".split(" "),
                weekdays: "Sunday Monday Tuesday Wednesday Thursday Friday Saturday".split(" "),
                decimalPoint: ".",
                numericSymbols: "kMGTPE".split(""),
                resetZoom: "Reset zoom",
                resetZoomTitle: "Reset zoom level 1:1",
                thousandsSep: " "
            },
            global: {},
            time: {
                Date: void 0,
                getTimezoneOffset: void 0,
                timezone: void 0,
                timezoneOffset: 0,
                useUTC: !0
            },
            chart: {
                styledMode: !1,
                borderRadius: 0,
                colorCount: 10,
                defaultSeriesType: "line",
                ignoreHiddenSeries: !0,
                spacing: [10, 10, 15, 10],
                resetZoomButton: {
                    theme: {
                        zIndex: 6
                    },
                    position: {
                        align: "right",
                        x: -10,
                        y: 10
                    }
                },
                width: null,
                height: null,
                borderColor: "#335cad",
                backgroundColor: "#ffffff",
                plotBorderColor: "#cccccc"
            },
            title: {
                text: "Chart title",
                align: "center",
                margin: 15,
                widthAdjust: -44
            },
            subtitle: {
                text: "",
                align: "center",
                widthAdjust: -44
            },
            caption: {
                margin: 15,
                text: "",
                align: "left",
                verticalAlign: "bottom"
            },
            plotOptions: {},
            labels: {
                style: {
                    position: "absolute",
                    color: "#333333"
                }
            },
            legend: {
                enabled: !0,
                align: "center",
                alignColumns: !0,
                layout: "horizontal",
                labelFormatter: function () {
                    return this.name
                },
                borderColor: "#999999",
                borderRadius: 0,
                navigation: {
                    activeColor: "#003399",
                    inactiveColor: "#cccccc"
                },
                itemStyle: {
                    color: "#333333",
                    cursor: "pointer",
                    fontSize: "12px",
                    fontWeight: "bold",
                    textOverflow: "ellipsis"
                },
                itemHoverStyle: {
                    color: "#000000"
                },
                itemHiddenStyle: {
                    color: "#cccccc"
                },
                shadow: !1,
                itemCheckboxStyle: {
                    position: "absolute",
                    width: "13px",
                    height: "13px"
                },
                squareSymbol: !0,
                symbolPadding: 5,
                verticalAlign: "bottom",
                x: 0,
                y: 0,
                title: {
                    style: {
                        fontWeight: "bold"
                    }
                }
            },
            loading: {
                labelStyle: {
                    fontWeight: "bold",
                    position: "relative",
                    top: "45%"
                },
                style: {
                    position: "absolute",
                    backgroundColor: "#ffffff",
                    opacity: .5,
                    textAlign: "center"
                }
            },
            tooltip: {
                enabled: !0,
                animation: f.svg,
                borderRadius: 3,
                dateTimeLabelFormats: {
                    millisecond: "%A, %b %e, %H:%M:%S.%L",
                    second: "%A, %b %e, %H:%M:%S",
                    minute: "%A, %b %e, %H:%M",
                    hour: "%A, %b %e, %H:%M",
                    day: "%A, %b %e, %Y",
                    week: "Week from %A, %b %e, %Y",
                    month: "%B %Y",
                    year: "%Y"
                },
                footerFormat: "",
                padding: 8,
                snap: f.isTouchDevice ? 25 : 10,
                headerFormat: '<span style="font-size: 10px">{point.key}</span><br/>',
                pointFormat: '<span style="color:{point.color}">\u25cf</span> {series.name}: <b>{point.y}</b><br/>',
                backgroundColor: n("#f7f7f7").setOpacity(.85).get(),
                borderWidth: 1,
                shadow: !0,
                style: {
                    color: "#333333",
                    cursor: "default",
                    fontSize: "12px",
                    whiteSpace: "nowrap"
                }
            },
            credits: {
                enabled: !0,
                href: "https://www.highcharts.com?credits",
                position: {
                    align: "right",
                    x: -10,
                    verticalAlign: "bottom",
                    y: -5
                },
                style: {
                    cursor: "pointer",
                    color: "#999999",
                    fontSize: "9px"
                },
                text: "Highcharts.com"
            }
        };
        "";
        f.time = new a(y(f.defaultOptions.global, f.defaultOptions.time));
        f.dateFormat = function (a, n, C) {
            return f.time.dateFormat(a, n, C)
        };
        return {
            dateFormat: f.dateFormat,
            defaultOptions: f.defaultOptions,
            time: f.time
        }
    });
    O(n, "Core/Axis/Axis.js", [n["Core/Color.js"], n["Core/Globals.js"], n["Core/Axis/Tick.js"], n["Core/Utilities.js"], n["Core/Options.js"]], function (f, a, n, y, D) {
        var G = y.addEvent,
            C = y.animObject,
            J = y.arrayMax,
            H = y.arrayMin,
            v = y.clamp,
            L = y.correctFloat,
            q = y.defined,
            K = y.destroyObjectProperties,
            E = y.error,
            p = y.extend,
            t = y.fireEvent,
            I = y.format,
            u = y.getMagnitude,
            m = y.isArray,
            h = y.isFunction,
            l = y.isNumber,
            k = y.isString,
            g = y.merge,
            d = y.normalizeTickInterval,
            x = y.objectEach,
            r = y.pick,
            A = y.relativeLength,
            N = y.removeEvent,
            B = y.splat,
            M = y.syncTimeout,
            R = D.defaultOptions,
            F = a.deg2rad;
        y = function () {
            function e(c, b) {
                this.zoomEnabled = this.width = this.visible = this.userOptions = this.translationSlope = this.transB = this.transA = this.top = this.ticks = this.tickRotCorr = this.tickPositions = this.tickmarkOffset = this.tickInterval = this.tickAmount = this.side = this.series = this.right = this.positiveValuesOnly = this.pos = this.pointRangePadding = this.pointRange = this.plotLinesAndBandsGroups = this.plotLinesAndBands = this.paddedTicks =
                    this.overlap = this.options = this.oldMin = this.oldMax = this.offset = this.names = this.minPixelPadding = this.minorTicks = this.minorTickInterval = this.min = this.maxLabelLength = this.max = this.len = this.left = this.labelFormatter = this.labelEdge = this.isLinked = this.height = this.hasVisibleSeries = this.hasNames = this.coll = this.closestPointRange = this.chart = this.categories = this.bottom = this.alternateBands = void 0;
                this.init(c, b)
            }
            e.prototype.init = function (c, b) {
                var e = b.isX,
                    d = this;
                d.chart = c;
                d.horiz = c.inverted && !d.isZAxis ? !e : e;
                d.isXAxis =
                    e;
                d.coll = d.coll || (e ? "xAxis" : "yAxis");
                t(this, "init", {
                    userOptions: b
                });
                d.opposite = b.opposite;
                d.side = b.side || (d.horiz ? d.opposite ? 0 : 2 : d.opposite ? 1 : 3);
                d.setOptions(b);
                var g = this.options,
                    k = g.type;
                d.labelFormatter = g.labels.formatter || d.defaultLabelFormatter;
                d.userOptions = b;
                d.minPixelPadding = 0;
                d.reversed = g.reversed;
                d.visible = !1 !== g.visible;
                d.zoomEnabled = !1 !== g.zoomEnabled;
                d.hasNames = "category" === k || !0 === g.categories;
                d.categories = g.categories || d.hasNames;
                d.names || (d.names = [], d.names.keys = {});
                d.plotLinesAndBandsGroups = {};
                d.positiveValuesOnly = !!d.logarithmic;
                d.isLinked = q(g.linkedTo);
                d.ticks = {};
                d.labelEdge = [];
                d.minorTicks = {};
                d.plotLinesAndBands = [];
                d.alternateBands = {};
                d.len = 0;
                d.minRange = d.userMinRange = g.minRange || g.maxZoom;
                d.range = g.range;
                d.offset = g.offset || 0;
                d.max = null;
                d.min = null;
                d.crosshair = r(g.crosshair, B(c.options.tooltip.crosshairs)[e ? 0 : 1], !1);
                b = d.options.events; - 1 === c.axes.indexOf(d) && (e ? c.axes.splice(c.xAxis.length, 0, d) : c.axes.push(d), c[d.coll].push(d));
                d.series = d.series || [];
                c.inverted && !d.isZAxis && e && "undefined" ===
                    typeof d.reversed && (d.reversed = !0);
                d.labelRotation = d.options.labels.rotation;
                x(b, function (b, c) {
                    h(b) && G(d, c, b)
                });
                t(this, "afterInit")
            };
            e.prototype.setOptions = function (c) {
                this.options = g(e.defaultOptions, "yAxis" === this.coll && e.defaultYAxisOptions, [e.defaultTopAxisOptions, e.defaultRightAxisOptions, e.defaultBottomAxisOptions, e.defaultLeftAxisOptions][this.side], g(R[this.coll], c));
                t(this, "afterSetOptions", {
                    userOptions: c
                })
            };
            e.prototype.defaultLabelFormatter = function () {
                var c = this.axis,
                    b = l(this.value) ? this.value :
                    NaN,
                    e = c.chart.time,
                    d = c.categories,
                    g = this.dateTimeLabelFormat,
                    k = R.lang,
                    h = k.numericSymbols;
                k = k.numericSymbolMagnitude || 1E3;
                var a = h && h.length,
                    r = c.options.labels.format;
                c = c.logarithmic ? Math.abs(b) : c.tickInterval;
                var m = this.chart,
                    x = m.numberFormatter;
                if (r) var f = I(r, this, m);
                else if (d) f = "" + this.value;
                else if (g) f = e.dateFormat(g, b);
                else if (a && 1E3 <= c)
                    for (; a-- && "undefined" === typeof f;) e = Math.pow(k, a + 1), c >= e && 0 === 10 * b % e && null !== h[a] && 0 !== b && (f = x(b / e, -1) + h[a]);
                "undefined" === typeof f && (f = 1E4 <= Math.abs(b) ? x(b, -1) :
                    x(b, -1, void 0, ""));
                return f
            };
            e.prototype.getSeriesExtremes = function () {
                var c = this,
                    b = c.chart,
                    e;
                t(this, "getSeriesExtremes", null, function () {
                    c.hasVisibleSeries = !1;
                    c.dataMin = c.dataMax = c.threshold = null;
                    c.softThreshold = !c.isXAxis;
                    c.stacking && c.stacking.buildStacks();
                    c.series.forEach(function (d) {
                        if (d.visible || !b.options.chart.ignoreHiddenSeries) {
                            var g = d.options,
                                k = g.threshold;
                            c.hasVisibleSeries = !0;
                            c.positiveValuesOnly && 0 >= k && (k = null);
                            if (c.isXAxis) {
                                if (g = d.xData, g.length) {
                                    g = c.logarithmic ? g.filter(c.validatePositiveValue) :
                                        g;
                                    e = d.getXExtremes(g);
                                    var h = e.min;
                                    var a = e.max;
                                    l(h) || h instanceof Date || (g = g.filter(l), e = d.getXExtremes(g), h = e.min, a = e.max);
                                    g.length && (c.dataMin = Math.min(r(c.dataMin, h), h), c.dataMax = Math.max(r(c.dataMax, a), a))
                                }
                            } else if (d = d.applyExtremes(), l(d.dataMin) && (h = d.dataMin, c.dataMin = Math.min(r(c.dataMin, h), h)), l(d.dataMax) && (a = d.dataMax, c.dataMax = Math.max(r(c.dataMax, a), a)), q(k) && (c.threshold = k), !g.softThreshold || c.positiveValuesOnly) c.softThreshold = !1
                        }
                    })
                });
                t(this, "afterGetSeriesExtremes")
            };
            e.prototype.translate =
                function (c, b, e, d, g, k) {
                    var h = this.linkedParent || this,
                        a = 1,
                        w = 0,
                        z = d ? h.oldTransA : h.transA;
                    d = d ? h.oldMin : h.min;
                    var r = h.minPixelPadding;
                    g = (h.isOrdinal || h.brokenAxis && h.brokenAxis.hasBreaks || h.logarithmic && g) && h.lin2val;
                    z || (z = h.transA);
                    e && (a *= -1, w = h.len);
                    h.reversed && (a *= -1, w -= a * (h.sector || h.len));
                    b ? (c = (c * a + w - r) / z + d, g && (c = h.lin2val(c))) : (g && (c = h.val2lin(c)), c = l(d) ? a * (c - d) * z + w + a * r + (l(k) ? z * k : 0) : void 0);
                    return c
                };
            e.prototype.toPixels = function (c, b) {
                return this.translate(c, !1, !this.horiz, null, !0) + (b ? 0 : this.pos)
            };
            e.prototype.toValue = function (c, b) {
                return this.translate(c - (b ? 0 : this.pos), !0, !this.horiz, null, !0)
            };
            e.prototype.getPlotLinePath = function (c) {
                function b(b, c, e) {
                    if ("pass" !== f && b < c || b > e) f ? b = v(b, c, e) : q = !0;
                    return b
                }
                var e = this,
                    d = e.chart,
                    g = e.left,
                    k = e.top,
                    h = c.old,
                    a = c.value,
                    m = c.translatedValue,
                    x = c.lineWidth,
                    f = c.force,
                    p, B, A, M, F = h && d.oldChartHeight || d.chartHeight,
                    u = h && d.oldChartWidth || d.chartWidth,
                    q, N = e.transB;
                c = {
                    value: a,
                    lineWidth: x,
                    old: h,
                    force: f,
                    acrossPanes: c.acrossPanes,
                    translatedValue: m
                };
                t(this, "getPlotLinePath",
                    c,
                    function (c) {
                        m = r(m, e.translate(a, null, null, h));
                        m = v(m, -1E5, 1E5);
                        p = A = Math.round(m + N);
                        B = M = Math.round(F - m - N);
                        l(m) ? e.horiz ? (B = k, M = F - e.bottom, p = A = b(p, g, g + e.width)) : (p = g, A = u - e.right, B = M = b(B, k, k + e.height)) : (q = !0, f = !1);
                        c.path = q && !f ? null : d.renderer.crispLine([
                            ["M", p, B],
                            ["L", A, M]
                        ], x || 1)
                    });
                return c.path
            };
            e.prototype.getLinearTickPositions = function (c, b, e) {
                var d = L(Math.floor(b / c) * c);
                e = L(Math.ceil(e / c) * c);
                var g = [],
                    k;
                L(d + c) === d && (k = 20);
                if (this.single) return [b];
                for (b = d; b <= e;) {
                    g.push(b);
                    b = L(b + c, k);
                    if (b === h) break;
                    var h = b
                }
                return g
            };
            e.prototype.getMinorTickInterval = function () {
                var c = this.options;
                return !0 === c.minorTicks ? r(c.minorTickInterval, "auto") : !1 === c.minorTicks ? null : c.minorTickInterval
            };
            e.prototype.getMinorTickPositions = function () {
                var c = this.options,
                    b = this.tickPositions,
                    e = this.minorTickInterval,
                    d = [],
                    g = this.pointRangePadding || 0,
                    k = this.min - g;
                g = this.max + g;
                var h = g - k;
                if (h && h / e < this.len / 3) {
                    var a = this.logarithmic;
                    if (a) this.paddedTicks.forEach(function (b, c, g) {
                        c && d.push.apply(d, a.getLogTickPositions(e, g[c - 1], g[c],
                            !0))
                    });
                    else if (this.dateTime && "auto" === this.getMinorTickInterval()) d = d.concat(this.getTimeTicks(this.dateTime.normalizeTimeTickInterval(e), k, g, c.startOfWeek));
                    else
                        for (c = k + (b[0] - k) % e; c <= g && c !== d[0]; c += e) d.push(c)
                }
                0 !== d.length && this.trimTicks(d);
                return d
            };
            e.prototype.adjustForMinRange = function () {
                var c = this.options,
                    b = this.min,
                    e = this.max,
                    d = this.logarithmic,
                    g, k, h, a, l;
                this.isXAxis && "undefined" === typeof this.minRange && !d && (q(c.min) || q(c.max) ? this.minRange = null : (this.series.forEach(function (b) {
                    a = b.xData;
                    for (k = l = b.xIncrement ? 1 : a.length - 1; 0 < k; k--)
                        if (h = a[k] - a[k - 1], "undefined" === typeof g || h < g) g = h
                }), this.minRange = Math.min(5 * g, this.dataMax - this.dataMin)));
                if (e - b < this.minRange) {
                    var m = this.dataMax - this.dataMin >= this.minRange;
                    var x = this.minRange;
                    var f = (x - e + b) / 2;
                    f = [b - f, r(c.min, b - f)];
                    m && (f[2] = this.logarithmic ? this.logarithmic.log2lin(this.dataMin) : this.dataMin);
                    b = J(f);
                    e = [b + x, r(c.max, b + x)];
                    m && (e[2] = d ? d.log2lin(this.dataMax) : this.dataMax);
                    e = H(e);
                    e - b < x && (f[0] = e - x, f[1] = r(c.min, e - x), b = J(f))
                }
                this.min = b;
                this.max =
                    e
            };
            e.prototype.getClosest = function () {
                var c;
                this.categories ? c = 1 : this.series.forEach(function (b) {
                    var e = b.closestPointRange,
                        d = b.visible || !b.chart.options.chart.ignoreHiddenSeries;
                    !b.noSharedTooltip && q(e) && d && (c = q(c) ? Math.min(c, e) : e)
                });
                return c
            };
            e.prototype.nameToX = function (c) {
                var b = m(this.categories),
                    e = b ? this.categories : this.names,
                    d = c.options.x;
                c.series.requireSorting = !1;
                q(d) || (d = !1 === this.options.uniqueNames ? c.series.autoIncrement() : b ? e.indexOf(c.name) : r(e.keys[c.name], -1));
                if (-1 === d) {
                    if (!b) var g = e.length
                } else g =
                    d;
                "undefined" !== typeof g && (this.names[g] = c.name, this.names.keys[c.name] = g);
                return g
            };
            e.prototype.updateNames = function () {
                var c = this,
                    b = this.names;
                0 < b.length && (Object.keys(b.keys).forEach(function (c) {
                    delete b.keys[c]
                }), b.length = 0, this.minRange = this.userMinRange, (this.series || []).forEach(function (b) {
                    b.xIncrement = null;
                    if (!b.points || b.isDirtyData) c.max = Math.max(c.max, b.xData.length - 1), b.processData(), b.generatePoints();
                    b.data.forEach(function (e, d) {
                        if (e && e.options && "undefined" !== typeof e.name) {
                            var g = c.nameToX(e);
                            "undefined" !== typeof g && g !== e.x && (e.x = g, b.xData[d] = g)
                        }
                    })
                }))
            };
            e.prototype.setAxisTranslation = function (c) {
                var b = this,
                    e = b.max - b.min,
                    d = b.axisPointRange || 0,
                    g = 0,
                    h = 0,
                    a = b.linkedParent,
                    l = !!b.categories,
                    m = b.transA,
                    x = b.isXAxis;
                if (x || l || d) {
                    var f = b.getClosest();
                    a ? (g = a.minPointOffset, h = a.pointRangePadding) : b.series.forEach(function (c) {
                        var e = l ? 1 : x ? r(c.options.pointRange, f, 0) : b.axisPointRange || 0,
                            a = c.options.pointPlacement;
                        d = Math.max(d, e);
                        if (!b.single || l) c = c.is("xrange") ? !x : x, g = Math.max(g, c && k(a) ? 0 : e / 2), h = Math.max(h,
                            c && "on" === a ? 0 : e)
                    });
                    a = b.ordinal && b.ordinal.slope && f ? b.ordinal.slope / f : 1;
                    b.minPointOffset = g *= a;
                    b.pointRangePadding = h *= a;
                    b.pointRange = Math.min(d, b.single && l ? 1 : e);
                    x && (b.closestPointRange = f)
                }
                c && (b.oldTransA = m);
                b.translationSlope = b.transA = m = b.staticScale || b.len / (e + h || 1);
                b.transB = b.horiz ? b.left : b.bottom;
                b.minPixelPadding = m * g;
                t(this, "afterSetAxisTranslation")
            };
            e.prototype.minFromRange = function () {
                return this.max - this.range
            };
            e.prototype.setTickInterval = function (c) {
                var b = this,
                    e = b.chart,
                    g = b.logarithmic,
                    k = b.options,
                    h = b.isXAxis,
                    a = b.isLinked,
                    m = k.maxPadding,
                    x = k.minPadding,
                    f = k.tickInterval,
                    p = k.tickPixelInterval,
                    B = b.categories,
                    A = l(b.threshold) ? b.threshold : null,
                    Q = b.softThreshold;
                b.dateTime || B || a || this.getTickAmount();
                var M = r(b.userMin, k.min);
                var F = r(b.userMax, k.max);
                if (a) {
                    b.linkedParent = e[b.coll][k.linkedTo];
                    var N = b.linkedParent.getExtremes();
                    b.min = r(N.min, N.dataMin);
                    b.max = r(N.max, N.dataMax);
                    k.type !== b.linkedParent.options.type && E(11, 1, e)
                } else {
                    if (Q && q(A))
                        if (b.dataMin >= A) N = A, x = 0;
                        else if (b.dataMax <= A) {
                        var v = A;
                        m = 0
                    }
                    b.min =
                        r(M, N, b.dataMin);
                    b.max = r(F, v, b.dataMax)
                }
                g && (b.positiveValuesOnly && !c && 0 >= Math.min(b.min, r(b.dataMin, b.min)) && E(10, 1, e), b.min = L(g.log2lin(b.min), 16), b.max = L(g.log2lin(b.max), 16));
                b.range && q(b.max) && (b.userMin = b.min = M = Math.max(b.dataMin, b.minFromRange()), b.userMax = F = b.max, b.range = null);
                t(b, "foundExtremes");
                b.beforePadding && b.beforePadding();
                b.adjustForMinRange();
                !(B || b.axisPointRange || b.stacking && b.stacking.usePercentage || a) && q(b.min) && q(b.max) && (e = b.max - b.min) && (!q(M) && x && (b.min -= e * x), !q(F) && m && (b.max +=
                    e * m));
                l(b.userMin) || (l(k.softMin) && k.softMin < b.min && (b.min = M = k.softMin), l(k.floor) && (b.min = Math.max(b.min, k.floor)));
                l(b.userMax) || (l(k.softMax) && k.softMax > b.max && (b.max = F = k.softMax), l(k.ceiling) && (b.max = Math.min(b.max, k.ceiling)));
                Q && q(b.dataMin) && (A = A || 0, !q(M) && b.min < A && b.dataMin >= A ? b.min = b.options.minRange ? Math.min(A, b.max - b.minRange) : A : !q(F) && b.max > A && b.dataMax <= A && (b.max = b.options.minRange ? Math.max(A, b.min + b.minRange) : A));
                b.tickInterval = b.min === b.max || "undefined" === typeof b.min || "undefined" ===
                    typeof b.max ? 1 : a && !f && p === b.linkedParent.options.tickPixelInterval ? f = b.linkedParent.tickInterval : r(f, this.tickAmount ? (b.max - b.min) / Math.max(this.tickAmount - 1, 1) : void 0, B ? 1 : (b.max - b.min) * p / Math.max(b.len, p));
                h && !c && b.series.forEach(function (c) {
                    c.processData(b.min !== b.oldMin || b.max !== b.oldMax)
                });
                b.setAxisTranslation(!0);
                t(this, "initialAxisTranslation");
                b.pointRange && !f && (b.tickInterval = Math.max(b.pointRange, b.tickInterval));
                c = r(k.minTickInterval, b.dateTime && !b.series.some(function (b) {
                        return b.noSharedTooltip
                    }) ?
                    b.closestPointRange : 0);
                !f && b.tickInterval < c && (b.tickInterval = c);
                b.dateTime || b.logarithmic || f || (b.tickInterval = d(b.tickInterval, void 0, u(b.tickInterval), r(k.allowDecimals, .5 > b.tickInterval || void 0 !== this.tickAmount), !!this.tickAmount));
                this.tickAmount || (b.tickInterval = b.unsquish());
                this.setTickPositions()
            };
            e.prototype.setTickPositions = function () {
                var c = this.options,
                    b = c.tickPositions;
                var e = this.getMinorTickInterval();
                var d = c.tickPositioner,
                    g = this.hasVerticalPanning(),
                    k = "colorAxis" === this.coll,
                    h = (k ||
                        !g) && c.startOnTick;
                g = (k || !g) && c.endOnTick;
                this.tickmarkOffset = this.categories && "between" === c.tickmarkPlacement && 1 === this.tickInterval ? .5 : 0;
                this.minorTickInterval = "auto" === e && this.tickInterval ? this.tickInterval / 5 : e;
                this.single = this.min === this.max && q(this.min) && !this.tickAmount && (parseInt(this.min, 10) === this.min || !1 !== c.allowDecimals);
                this.tickPositions = e = b && b.slice();
                !e && (this.ordinal && this.ordinal.positions || !((this.max - this.min) / this.tickInterval > Math.max(2 * this.len, 200)) ? e = this.dateTime ? this.getTimeTicks(this.dateTime.normalizeTimeTickInterval(this.tickInterval,
                    c.units), this.min, this.max, c.startOfWeek, this.ordinal && this.ordinal.positions, this.closestPointRange, !0) : this.logarithmic ? this.logarithmic.getLogTickPositions(this.tickInterval, this.min, this.max) : this.getLinearTickPositions(this.tickInterval, this.min, this.max) : (e = [this.min, this.max], E(19, !1, this.chart)), e.length > this.len && (e = [e[0], e.pop()], e[0] === e[1] && (e.length = 1)), this.tickPositions = e, d && (d = d.apply(this, [this.min, this.max]))) && (this.tickPositions = e = d);
                this.paddedTicks = e.slice(0);
                this.trimTicks(e,
                    h, g);
                this.isLinked || (this.single && 2 > e.length && !this.categories && !this.series.some(function (b) {
                    return b.is("heatmap") && "between" === b.options.pointPlacement
                }) && (this.min -= .5, this.max += .5), b || d || this.adjustTickAmount());
                t(this, "afterSetTickPositions")
            };
            e.prototype.trimTicks = function (c, b, e) {
                var d = c[0],
                    g = c[c.length - 1],
                    k = !this.isOrdinal && this.minPointOffset || 0;
                t(this, "trimTicks");
                if (!this.isLinked) {
                    if (b && -Infinity !== d) this.min = d;
                    else
                        for (; this.min - k > c[0];) c.shift();
                    if (e) this.max = g;
                    else
                        for (; this.max + k <
                            c[c.length - 1];) c.pop();
                    0 === c.length && q(d) && !this.options.tickPositions && c.push((g + d) / 2)
                }
            };
            e.prototype.alignToOthers = function () {
                var c = {},
                    b, e = this.options;
                !1 === this.chart.options.chart.alignTicks || !1 === e.alignTicks || !1 === e.startOnTick || !1 === e.endOnTick || this.logarithmic || this.chart[this.coll].forEach(function (e) {
                    var d = e.options;
                    d = [e.horiz ? d.left : d.top, d.width, d.height, d.pane].join();
                    e.series.length && (c[d] ? b = !0 : c[d] = 1)
                });
                return b
            };
            e.prototype.getTickAmount = function () {
                var c = this.options,
                    b = c.tickAmount,
                    e = c.tickPixelInterval;
                !q(c.tickInterval) && !b && this.len < e && !this.isRadial && !this.logarithmic && c.startOnTick && c.endOnTick && (b = 2);
                !b && this.alignToOthers() && (b = Math.ceil(this.len / e) + 1);
                4 > b && (this.finalTickAmt = b, b = 5);
                this.tickAmount = b
            };
            e.prototype.adjustTickAmount = function () {
                var c = this.options,
                    b = this.tickInterval,
                    e = this.tickPositions,
                    d = this.tickAmount,
                    g = this.finalTickAmt,
                    k = e && e.length,
                    h = r(this.threshold, this.softThreshold ? 0 : null),
                    a;
                if (this.hasData()) {
                    if (k < d) {
                        for (a = this.min; e.length < d;) e.length % 2 || a ===
                            h ? e.push(L(e[e.length - 1] + b)) : e.unshift(L(e[0] - b));
                        this.transA *= (k - 1) / (d - 1);
                        this.min = c.startOnTick ? e[0] : Math.min(this.min, e[0]);
                        this.max = c.endOnTick ? e[e.length - 1] : Math.max(this.max, e[e.length - 1])
                    } else k > d && (this.tickInterval *= 2, this.setTickPositions());
                    if (q(g)) {
                        for (b = c = e.length; b--;)(3 === g && 1 === b % 2 || 2 >= g && 0 < b && b < c - 1) && e.splice(b, 1);
                        this.finalTickAmt = void 0
                    }
                }
            };
            e.prototype.setScale = function () {
                var c, b = !1,
                    e = !1;
                this.series.forEach(function (c) {
                    var d;
                    b = b || c.isDirtyData || c.isDirty;
                    e = e || (null === (d = c.xAxis) ||
                        void 0 === d ? void 0 : d.isDirty) || !1
                });
                this.oldMin = this.min;
                this.oldMax = this.max;
                this.oldAxisLength = this.len;
                this.setAxisSize();
                (c = this.len !== this.oldAxisLength) || b || e || this.isLinked || this.forceRedraw || this.userMin !== this.oldUserMin || this.userMax !== this.oldUserMax || this.alignToOthers() ? (this.stacking && this.stacking.resetStacks(), this.forceRedraw = !1, this.getSeriesExtremes(), this.setTickInterval(), this.oldUserMin = this.userMin, this.oldUserMax = this.userMax, this.isDirty || (this.isDirty = c || this.min !== this.oldMin ||
                    this.max !== this.oldMax)) : this.stacking && this.stacking.cleanStacks();
                b && this.panningState && (this.panningState.isDirty = !0);
                t(this, "afterSetScale")
            };
            e.prototype.setExtremes = function (c, b, e, d, g) {
                var k = this,
                    h = k.chart;
                e = r(e, !0);
                k.series.forEach(function (b) {
                    delete b.kdTree
                });
                g = p(g, {
                    min: c,
                    max: b
                });
                t(k, "setExtremes", g, function () {
                    k.userMin = c;
                    k.userMax = b;
                    k.eventArgs = g;
                    e && h.redraw(d)
                })
            };
            e.prototype.zoom = function (c, b) {
                var e = this,
                    d = this.dataMin,
                    g = this.dataMax,
                    k = this.options,
                    h = Math.min(d, r(k.min, d)),
                    a = Math.max(g,
                        r(k.max, g));
                c = {
                    newMin: c,
                    newMax: b
                };
                t(this, "zoom", c, function (b) {
                    var c = b.newMin,
                        k = b.newMax;
                    if (c !== e.min || k !== e.max) e.allowZoomOutside || (q(d) && (c < h && (c = h), c > a && (c = a)), q(g) && (k < h && (k = h), k > a && (k = a))), e.displayBtn = "undefined" !== typeof c || "undefined" !== typeof k, e.setExtremes(c, k, !1, void 0, {
                        trigger: "zoom"
                    });
                    b.zoomed = !0
                });
                return c.zoomed
            };
            e.prototype.setAxisSize = function () {
                var c = this.chart,
                    b = this.options,
                    e = b.offsets || [0, 0, 0, 0],
                    d = this.horiz,
                    g = this.width = Math.round(A(r(b.width, c.plotWidth - e[3] + e[1]), c.plotWidth)),
                    k = this.height = Math.round(A(r(b.height, c.plotHeight - e[0] + e[2]), c.plotHeight)),
                    h = this.top = Math.round(A(r(b.top, c.plotTop + e[0]), c.plotHeight, c.plotTop));
                b = this.left = Math.round(A(r(b.left, c.plotLeft + e[3]), c.plotWidth, c.plotLeft));
                this.bottom = c.chartHeight - k - h;
                this.right = c.chartWidth - g - b;
                this.len = Math.max(d ? g : k, 0);
                this.pos = d ? b : h
            };
            e.prototype.getExtremes = function () {
                var c = this.logarithmic;
                return {
                    min: c ? L(c.lin2log(this.min)) : this.min,
                    max: c ? L(c.lin2log(this.max)) : this.max,
                    dataMin: this.dataMin,
                    dataMax: this.dataMax,
                    userMin: this.userMin,
                    userMax: this.userMax
                }
            };
            e.prototype.getThreshold = function (c) {
                var b = this.logarithmic,
                    e = b ? b.lin2log(this.min) : this.min;
                b = b ? b.lin2log(this.max) : this.max;
                null === c || -Infinity === c ? c = e : Infinity === c ? c = b : e > c ? c = e : b < c && (c = b);
                return this.translate(c, 0, 1, 0, 1)
            };
            e.prototype.autoLabelAlign = function (c) {
                var b = (r(c, 0) - 90 * this.side + 720) % 360;
                c = {
                    align: "center"
                };
                t(this, "autoLabelAlign", c, function (c) {
                    15 < b && 165 > b ? c.align = "right" : 195 < b && 345 > b && (c.align = "left")
                });
                return c.align
            };
            e.prototype.tickSize = function (c) {
                var b =
                    this.options,
                    e = b["tick" === c ? "tickLength" : "minorTickLength"],
                    d = r(b["tick" === c ? "tickWidth" : "minorTickWidth"], "tick" === c && this.isXAxis && !this.categories ? 1 : 0);
                if (d && e) {
                    "inside" === b[c + "Position"] && (e = -e);
                    var g = [e, d]
                }
                c = {
                    tickSize: g
                };
                t(this, "afterTickSize", c);
                return c.tickSize
            };
            e.prototype.labelMetrics = function () {
                var c = this.tickPositions && this.tickPositions[0] || 0;
                return this.chart.renderer.fontMetrics(this.options.labels.style && this.options.labels.style.fontSize, this.ticks[c] && this.ticks[c].label)
            };
            e.prototype.unsquish =
                function () {
                    var c = this.options.labels,
                        b = this.horiz,
                        e = this.tickInterval,
                        d = e,
                        g = this.len / (((this.categories ? 1 : 0) + this.max - this.min) / e),
                        k, h = c.rotation,
                        a = this.labelMetrics(),
                        l, m = Number.MAX_VALUE,
                        x, f = this.max - this.min,
                        p = function (b) {
                            var c = b / (g || 1);
                            c = 1 < c ? Math.ceil(c) : 1;
                            c * e > f && Infinity !== b && Infinity !== g && f && (c = Math.ceil(f / e));
                            return L(c * e)
                        };
                    b ? (x = !c.staggerLines && !c.step && (q(h) ? [h] : g < r(c.autoRotationLimit, 80) && c.autoRotation)) && x.forEach(function (b) {
                        if (b === h || b && -90 <= b && 90 >= b) {
                            l = p(Math.abs(a.h / Math.sin(F * b)));
                            var c = l + Math.abs(b / 360);
                            c < m && (m = c, k = b, d = l)
                        }
                    }) : c.step || (d = p(a.h));
                    this.autoRotation = x;
                    this.labelRotation = r(k, h);
                    return d
                };
            e.prototype.getSlotWidth = function (c) {
                var b, e = this.chart,
                    d = this.horiz,
                    g = this.options.labels,
                    k = Math.max(this.tickPositions.length - (this.categories ? 0 : 1), 1),
                    h = e.margin[3];
                if (c && l(c.slotWidth)) return c.slotWidth;
                if (d && g && 2 > (g.step || 0)) return g.rotation ? 0 : (this.staggerLines || 1) * this.len / k;
                if (!d) {
                    c = null === (b = null === g || void 0 === g ? void 0 : g.style) || void 0 === b ? void 0 : b.width;
                    if (void 0 !== c) return parseInt(c,
                        10);
                    if (h) return h - e.spacing[3]
                }
                return .33 * e.chartWidth
            };
            e.prototype.renderUnsquish = function () {
                var c = this.chart,
                    b = c.renderer,
                    e = this.tickPositions,
                    d = this.ticks,
                    g = this.options.labels,
                    h = g && g.style || {},
                    a = this.horiz,
                    l = this.getSlotWidth(),
                    m = Math.max(1, Math.round(l - 2 * (g.padding || 5))),
                    r = {},
                    x = this.labelMetrics(),
                    f = g.style && g.style.textOverflow,
                    p = 0;
                k(g.rotation) || (r.rotation = g.rotation || 0);
                e.forEach(function (b) {
                    b = d[b];
                    b.movedLabel && b.replaceMovedLabel();
                    b && b.label && b.label.textPxLength > p && (p = b.label.textPxLength)
                });
                this.maxLabelLength = p;
                if (this.autoRotation) p > m && p > x.h ? r.rotation = this.labelRotation : this.labelRotation = 0;
                else if (l) {
                    var B = m;
                    if (!f) {
                        var A = "clip";
                        for (m = e.length; !a && m--;) {
                            var t = e[m];
                            if (t = d[t].label) t.styles && "ellipsis" === t.styles.textOverflow ? t.css({
                                textOverflow: "clip"
                            }) : t.textPxLength > l && t.css({
                                width: l + "px"
                            }), t.getBBox().height > this.len / e.length - (x.h - x.f) && (t.specificTextOverflow = "ellipsis")
                        }
                    }
                }
                r.rotation && (B = p > .5 * c.chartHeight ? .33 * c.chartHeight : p, f || (A = "ellipsis"));
                if (this.labelAlign = g.align || this.autoLabelAlign(this.labelRotation)) r.align =
                    this.labelAlign;
                e.forEach(function (b) {
                    var c = (b = d[b]) && b.label,
                        e = h.width,
                        g = {};
                    c && (c.attr(r), b.shortenLabel ? b.shortenLabel() : B && !e && "nowrap" !== h.whiteSpace && (B < c.textPxLength || "SPAN" === c.element.tagName) ? (g.width = B + "px", f || (g.textOverflow = c.specificTextOverflow || A), c.css(g)) : c.styles && c.styles.width && !g.width && !e && c.css({
                        width: null
                    }), delete c.specificTextOverflow, b.rotation = r.rotation)
                }, this);
                this.tickRotCorr = b.rotCorr(x.b, this.labelRotation || 0, 0 !== this.side)
            };
            e.prototype.hasData = function () {
                return this.series.some(function (c) {
                        return c.hasData()
                    }) ||
                    this.options.showEmpty && q(this.min) && q(this.max)
            };
            e.prototype.addTitle = function (c) {
                var b = this.chart.renderer,
                    e = this.horiz,
                    d = this.opposite,
                    k = this.options.title,
                    h, a = this.chart.styledMode;
                this.axisTitle || ((h = k.textAlign) || (h = (e ? {
                        low: "left",
                        middle: "center",
                        high: "right"
                    } : {
                        low: d ? "right" : "left",
                        middle: "center",
                        high: d ? "left" : "right"
                    })[k.align]), this.axisTitle = b.text(k.text, 0, 0, k.useHTML).attr({
                        zIndex: 7,
                        rotation: k.rotation || 0,
                        align: h
                    }).addClass("highcharts-axis-title"), a || this.axisTitle.css(g(k.style)), this.axisTitle.add(this.axisGroup),
                    this.axisTitle.isNew = !0);
                a || k.style.width || this.isRadial || this.axisTitle.css({
                    width: this.len + "px"
                });
                this.axisTitle[c ? "show" : "hide"](c)
            };
            e.prototype.generateTick = function (c) {
                var b = this.ticks;
                b[c] ? b[c].addLabel() : b[c] = new n(this, c)
            };
            e.prototype.getOffset = function () {
                var c = this,
                    b = c.chart,
                    e = b.renderer,
                    d = c.options,
                    g = c.tickPositions,
                    k = c.ticks,
                    h = c.horiz,
                    a = c.side,
                    l = b.inverted && !c.isZAxis ? [1, 0, 3, 2][a] : a,
                    m, f = 0,
                    p = 0,
                    B = d.title,
                    A = d.labels,
                    M = 0,
                    F = b.axisOffset;
                b = b.clipOffset;
                var u = [-1, 1, 1, -1][a],
                    N = d.className,
                    v = c.axisParent;
                var I = c.hasData();
                c.showAxis = m = I || r(d.showEmpty, !0);
                c.staggerLines = c.horiz && A.staggerLines;
                c.axisGroup || (c.gridGroup = e.g("grid").attr({
                    zIndex: d.gridZIndex || 1
                }).addClass("highcharts-" + this.coll.toLowerCase() + "-grid " + (N || "")).add(v), c.axisGroup = e.g("axis").attr({
                    zIndex: d.zIndex || 2
                }).addClass("highcharts-" + this.coll.toLowerCase() + " " + (N || "")).add(v), c.labelGroup = e.g("axis-labels").attr({
                    zIndex: A.zIndex || 7
                }).addClass("highcharts-" + c.coll.toLowerCase() + "-labels " + (N || "")).add(v));
                I || c.isLinked ? (g.forEach(function (b,
                    e) {
                    c.generateTick(b, e)
                }), c.renderUnsquish(), c.reserveSpaceDefault = 0 === a || 2 === a || {
                    1: "left",
                    3: "right"
                } [a] === c.labelAlign, r(A.reserveSpace, "center" === c.labelAlign ? !0 : null, c.reserveSpaceDefault) && g.forEach(function (b) {
                    M = Math.max(k[b].getLabelSize(), M)
                }), c.staggerLines && (M *= c.staggerLines), c.labelOffset = M * (c.opposite ? -1 : 1)) : x(k, function (b, c) {
                    b.destroy();
                    delete k[c]
                });
                if (B && B.text && !1 !== B.enabled && (c.addTitle(m), m && !1 !== B.reserveSpace)) {
                    c.titleOffset = f = c.axisTitle.getBBox()[h ? "height" : "width"];
                    var R = B.offset;
                    p = q(R) ? 0 : r(B.margin, h ? 5 : 10)
                }
                c.renderLine();
                c.offset = u * r(d.offset, F[a] ? F[a] + (d.margin || 0) : 0);
                c.tickRotCorr = c.tickRotCorr || {
                    x: 0,
                    y: 0
                };
                e = 0 === a ? -c.labelMetrics().h : 2 === a ? c.tickRotCorr.y : 0;
                p = Math.abs(M) + p;
                M && (p = p - e + u * (h ? r(A.y, c.tickRotCorr.y + 8 * u) : A.x));
                c.axisTitleMargin = r(R, p);
                c.getMaxLabelDimensions && (c.maxLabelDimensions = c.getMaxLabelDimensions(k, g));
                h = this.tickSize("tick");
                F[a] = Math.max(F[a], c.axisTitleMargin + f + u * c.offset, p, g && g.length && h ? h[0] + u * c.offset : 0);
                d = d.offset ? 0 : 2 * Math.floor(c.axisLine.strokeWidth() /
                    2);
                b[l] = Math.max(b[l], d);
                t(this, "afterGetOffset")
            };
            e.prototype.getLinePath = function (c) {
                var b = this.chart,
                    e = this.opposite,
                    d = this.offset,
                    g = this.horiz,
                    k = this.left + (e ? this.width : 0) + d;
                d = b.chartHeight - this.bottom - (e ? this.height : 0) + d;
                e && (c *= -1);
                return b.renderer.crispLine([
                    ["M", g ? this.left : k, g ? d : this.top],
                    ["L", g ? b.chartWidth - this.right : k, g ? d : b.chartHeight - this.bottom]
                ], c)
            };
            e.prototype.renderLine = function () {
                this.axisLine || (this.axisLine = this.chart.renderer.path().addClass("highcharts-axis-line").add(this.axisGroup),
                    this.chart.styledMode || this.axisLine.attr({
                        stroke: this.options.lineColor,
                        "stroke-width": this.options.lineWidth,
                        zIndex: 7
                    }))
            };
            e.prototype.getTitlePosition = function () {
                var c = this.horiz,
                    b = this.left,
                    e = this.top,
                    d = this.len,
                    g = this.options.title,
                    k = c ? b : e,
                    h = this.opposite,
                    a = this.offset,
                    l = g.x || 0,
                    m = g.y || 0,
                    r = this.axisTitle,
                    x = this.chart.renderer.fontMetrics(g.style && g.style.fontSize, r);
                r = Math.max(r.getBBox(null, 0).height - x.h - 1, 0);
                d = {
                    low: k + (c ? 0 : d),
                    middle: k + d / 2,
                    high: k + (c ? d : 0)
                } [g.align];
                b = (c ? e + this.height : b) + (c ? 1 : -1) *
                    (h ? -1 : 1) * this.axisTitleMargin + [-r, r, x.f, -r][this.side];
                c = {
                    x: c ? d + l : b + (h ? this.width : 0) + a + l,
                    y: c ? b + m - (h ? this.height : 0) + a : d + m
                };
                t(this, "afterGetTitlePosition", {
                    titlePosition: c
                });
                return c
            };
            e.prototype.renderMinorTick = function (c) {
                var b = this.chart.hasRendered && l(this.oldMin),
                    e = this.minorTicks;
                e[c] || (e[c] = new n(this, c, "minor"));
                b && e[c].isNew && e[c].render(null, !0);
                e[c].render(null, !1, 1)
            };
            e.prototype.renderTick = function (c, b) {
                var e = this.isLinked,
                    d = this.ticks,
                    g = this.chart.hasRendered && l(this.oldMin);
                if (!e || c >=
                    this.min && c <= this.max) d[c] || (d[c] = new n(this, c)), g && d[c].isNew && d[c].render(b, !0, -1), d[c].render(b)
            };
            e.prototype.render = function () {
                var c = this,
                    b = c.chart,
                    e = c.logarithmic,
                    d = c.options,
                    g = c.isLinked,
                    k = c.tickPositions,
                    h = c.axisTitle,
                    m = c.ticks,
                    r = c.minorTicks,
                    f = c.alternateBands,
                    p = d.stackLabels,
                    B = d.alternateGridColor,
                    A = c.tickmarkOffset,
                    Q = c.axisLine,
                    F = c.showAxis,
                    u = C(b.renderer.globalAnimation),
                    q, N;
                c.labelEdge.length = 0;
                c.overlap = !1;
                [m, r, f].forEach(function (b) {
                    x(b, function (b) {
                        b.isActive = !1
                    })
                });
                if (c.hasData() ||
                    g) c.minorTickInterval && !c.categories && c.getMinorTickPositions().forEach(function (b) {
                    c.renderMinorTick(b)
                }), k.length && (k.forEach(function (b, e) {
                    c.renderTick(b, e)
                }), A && (0 === c.min || c.single) && (m[-1] || (m[-1] = new n(c, -1, null, !0)), m[-1].render(-1))), B && k.forEach(function (d, g) {
                    N = "undefined" !== typeof k[g + 1] ? k[g + 1] + A : c.max - A;
                    0 === g % 2 && d < c.max && N <= c.max + (b.polar ? -A : A) && (f[d] || (f[d] = new a.PlotLineOrBand(c)), q = d + A, f[d].options = {
                            from: e ? e.lin2log(q) : q,
                            to: e ? e.lin2log(N) : N,
                            color: B,
                            className: "highcharts-alternate-grid"
                        },
                        f[d].render(), f[d].isActive = !0)
                }), c._addedPlotLB || ((d.plotLines || []).concat(d.plotBands || []).forEach(function (b) {
                    c.addPlotBandOrLine(b)
                }), c._addedPlotLB = !0);
                [m, r, f].forEach(function (c) {
                    var e, d = [],
                        g = u.duration;
                    x(c, function (b, c) {
                        b.isActive || (b.render(c, !1, 0), b.isActive = !1, d.push(c))
                    });
                    M(function () {
                        for (e = d.length; e--;) c[d[e]] && !c[d[e]].isActive && (c[d[e]].destroy(), delete c[d[e]])
                    }, c !== f && b.hasRendered && g ? g : 0)
                });
                Q && (Q[Q.isPlaced ? "animate" : "attr"]({
                    d: this.getLinePath(Q.strokeWidth())
                }), Q.isPlaced = !0, Q[F ?
                    "show" : "hide"](F));
                h && F && (d = c.getTitlePosition(), l(d.y) ? (h[h.isNew ? "attr" : "animate"](d), h.isNew = !1) : (h.attr("y", -9999), h.isNew = !0));
                p && p.enabled && c.stacking && c.stacking.renderStackTotals();
                c.isDirty = !1;
                t(this, "afterRender")
            };
            e.prototype.redraw = function () {
                this.visible && (this.render(), this.plotLinesAndBands.forEach(function (c) {
                    c.render()
                }));
                this.series.forEach(function (c) {
                    c.isDirty = !0
                })
            };
            e.prototype.getKeepProps = function () {
                return this.keepProps || e.keepProps
            };
            e.prototype.destroy = function (c) {
                var b = this,
                    e = b.plotLinesAndBands,
                    d;
                t(this, "destroy", {
                    keepEvents: c
                });
                c || N(b);
                [b.ticks, b.minorTicks, b.alternateBands].forEach(function (b) {
                    K(b)
                });
                if (e)
                    for (c = e.length; c--;) e[c].destroy();
                "axisLine axisTitle axisGroup gridGroup labelGroup cross scrollbar".split(" ").forEach(function (c) {
                    b[c] && (b[c] = b[c].destroy())
                });
                for (d in b.plotLinesAndBandsGroups) b.plotLinesAndBandsGroups[d] = b.plotLinesAndBandsGroups[d].destroy();
                x(b, function (c, e) {
                    -1 === b.getKeepProps().indexOf(e) && delete b[e]
                })
            };
            e.prototype.drawCrosshair = function (c,
                b) {
                var e = this.crosshair,
                    d = r(e.snap, !0),
                    g, k = this.cross,
                    h = this.chart;
                t(this, "drawCrosshair", {
                    e: c,
                    point: b
                });
                c || (c = this.cross && this.cross.e);
                if (this.crosshair && !1 !== (q(b) || !d)) {
                    d ? q(b) && (g = r("colorAxis" !== this.coll ? b.crosshairPos : null, this.isXAxis ? b.plotX : this.len - b.plotY)) : g = c && (this.horiz ? c.chartX - this.pos : this.len - c.chartY + this.pos);
                    if (q(g)) {
                        var a = {
                            value: b && (this.isXAxis ? b.x : r(b.stackY, b.y)),
                            translatedValue: g
                        };
                        h.polar && p(a, {
                            isCrosshair: !0,
                            chartX: c && c.chartX,
                            chartY: c && c.chartY,
                            point: b
                        });
                        a = this.getPlotLinePath(a) ||
                            null
                    }
                    if (!q(a)) {
                        this.hideCrosshair();
                        return
                    }
                    d = this.categories && !this.isRadial;
                    k || (this.cross = k = h.renderer.path().addClass("highcharts-crosshair highcharts-crosshair-" + (d ? "category " : "thin ") + e.className).attr({
                        zIndex: r(e.zIndex, 2)
                    }).add(), h.styledMode || (k.attr({
                        stroke: e.color || (d ? f.parse("#ccd6eb").setOpacity(.25).get() : "#cccccc"),
                        "stroke-width": r(e.width, 1)
                    }).css({
                        "pointer-events": "none"
                    }), e.dashStyle && k.attr({
                        dashstyle: e.dashStyle
                    })));
                    k.show().attr({
                        d: a
                    });
                    d && !e.width && k.attr({
                        "stroke-width": this.transA
                    });
                    this.cross.e = c
                } else this.hideCrosshair();
                t(this, "afterDrawCrosshair", {
                    e: c,
                    point: b
                })
            };
            e.prototype.hideCrosshair = function () {
                this.cross && this.cross.hide();
                t(this, "afterHideCrosshair")
            };
            e.prototype.hasVerticalPanning = function () {
                var c, b;
                return /y/.test((null === (b = null === (c = this.chart.options.chart) || void 0 === c ? void 0 : c.panning) || void 0 === b ? void 0 : b.type) || "")
            };
            e.prototype.validatePositiveValue = function (c) {
                return l(c) && 0 < c
            };
            e.defaultOptions = {
                dateTimeLabelFormats: {
                    millisecond: {
                        main: "%H:%M:%S.%L",
                        range: !1
                    },
                    second: {
                        main: "%H:%M:%S",
                        range: !1
                    },
                    minute: {
                        main: "%H:%M",
                        range: !1
                    },
                    hour: {
                        main: "%H:%M",
                        range: !1
                    },
                    day: {
                        main: "%e. %b"
                    },
                    week: {
                        main: "%e. %b"
                    },
                    month: {
                        main: "%b '%y"
                    },
                    year: {
                        main: "%Y"
                    }
                },
                endOnTick: !1,
                labels: {
                    enabled: !0,
                    indentation: 10,
                    x: 0,
                    style: {
                        color: "#666666",
                        cursor: "default",
                        fontSize: "11px"
                    }
                },
                maxPadding: .01,
                minorTickLength: 2,
                minorTickPosition: "outside",
                minPadding: .01,
                showEmpty: !0,
                startOfWeek: 1,
                startOnTick: !1,
                tickLength: 10,
                tickPixelInterval: 100,
                tickmarkPlacement: "between",
                tickPosition: "outside",
                title: {
                    align: "middle",
                    style: {
                        color: "#666666"
                    }
                },
                type: "linear",
                minorGridLineColor: "#f2f2f2",
                minorGridLineWidth: 1,
                minorTickColor: "#999999",
                lineColor: "#ccd6eb",
                lineWidth: 1,
                gridLineColor: "#e6e6e6",
                tickColor: "#ccd6eb"
            };
            e.defaultYAxisOptions = {
                endOnTick: !0,
                maxPadding: .05,
                minPadding: .05,
                tickPixelInterval: 72,
                showLastLabel: !0,
                labels: {
                    x: -8
                },
                startOnTick: !0,
                title: {
                    rotation: 270,
                    text: "Values"
                },
                stackLabels: {
                    animation: {},
                    allowOverlap: !1,
                    enabled: !1,
                    crop: !0,
                    overflow: "justify",
                    formatter: function () {
                        var c = this.axis.chart.numberFormatter;
                        return c(this.total,
                            -1)
                    },
                    style: {
                        color: "#000000",
                        fontSize: "11px",
                        fontWeight: "bold",
                        textOutline: "1px contrast"
                    }
                },
                gridLineWidth: 1,
                lineWidth: 0
            };
            e.defaultLeftAxisOptions = {
                labels: {
                    x: -15
                },
                title: {
                    rotation: 270
                }
            };
            e.defaultRightAxisOptions = {
                labels: {
                    x: 15
                },
                title: {
                    rotation: 90
                }
            };
            e.defaultBottomAxisOptions = {
                labels: {
                    autoRotation: [-45],
                    x: 0
                },
                margin: 15,
                title: {
                    rotation: 0
                }
            };
            e.defaultTopAxisOptions = {
                labels: {
                    autoRotation: [-45],
                    x: 0
                },
                margin: 15,
                title: {
                    rotation: 0
                }
            };
            e.keepProps = "extKey hcEvents names series userMax userMin".split(" ");
            return e
        }();
        a.Axis = y;
        return a.Axis
    });
    O(n, "Core/Axis/DateTimeAxis.js", [n["Core/Axis/Axis.js"], n["Core/Utilities.js"]], function (f, a) {
        var n = a.addEvent,
            y = a.getMagnitude,
            D = a.normalizeTickInterval,
            G = a.timeUnits,
            C = function () {
                function a(a) {
                    this.axis = a
                }
                a.prototype.normalizeTimeTickInterval = function (a, f) {
                    var v = f || [
                        ["millisecond", [1, 2, 5, 10, 20, 25, 50, 100, 200, 500]],
                        ["second", [1, 2, 5, 10, 15, 30]],
                        ["minute", [1, 2, 5, 10, 15, 30]],
                        ["hour", [1, 2, 3, 4, 6, 8, 12]],
                        ["day", [1, 2]],
                        ["week", [1, 2]],
                        ["month", [1, 2, 3, 4, 6]],
                        ["year", null]
                    ];
                    f = v[v.length -
                        1];
                    var q = G[f[0]],
                        H = f[1],
                        E;
                    for (E = 0; E < v.length && !(f = v[E], q = G[f[0]], H = f[1], v[E + 1] && a <= (q * H[H.length - 1] + G[v[E + 1][0]]) / 2); E++);
                    q === G.year && a < 5 * q && (H = [1, 2, 5]);
                    a = D(a / q, H, "year" === f[0] ? Math.max(y(a / q), 1) : 1);
                    return {
                        unitRange: q,
                        count: a,
                        unitName: f[0]
                    }
                };
                return a
            }();
        a = function () {
            function a() {}
            a.compose = function (a) {
                a.keepProps.push("dateTime");
                a.prototype.getTimeTicks = function () {
                    return this.chart.time.getTimeTicks.apply(this.chart.time, arguments)
                };
                n(a, "init", function (a) {
                    "datetime" !== a.userOptions.type ? this.dateTime =
                        void 0 : this.dateTime || (this.dateTime = new C(this))
                })
            };
            a.AdditionsClass = C;
            return a
        }();
        a.compose(f);
        return a
    });
    O(n, "Core/Axis/LogarithmicAxis.js", [n["Core/Axis/Axis.js"], n["Core/Utilities.js"]], function (f, a) {
        var n = a.addEvent,
            y = a.getMagnitude,
            D = a.normalizeTickInterval,
            G = a.pick,
            C = function () {
                function a(a) {
                    this.axis = a
                }
                a.prototype.getLogTickPositions = function (a, f, n, q) {
                    var v = this.axis,
                        E = v.len,
                        p = v.options,
                        t = [];
                    q || (this.minorAutoInterval = void 0);
                    if (.5 <= a) a = Math.round(a), t = v.getLinearTickPositions(a, f, n);
                    else if (.08 <=
                        a) {
                        p = Math.floor(f);
                        var I, u;
                        for (E = .3 < a ? [1, 2, 4] : .15 < a ? [1, 2, 4, 6, 8] : [1, 2, 3, 4, 5, 6, 7, 8, 9]; p < n + 1 && !u; p++) {
                            var m = E.length;
                            for (I = 0; I < m && !u; I++) {
                                var h = this.log2lin(this.lin2log(p) * E[I]);
                                h > f && (!q || l <= n) && "undefined" !== typeof l && t.push(l);
                                l > n && (u = !0);
                                var l = h
                            }
                        }
                    } else f = this.lin2log(f), n = this.lin2log(n), a = q ? v.getMinorTickInterval() : p.tickInterval, a = G("auto" === a ? null : a, this.minorAutoInterval, p.tickPixelInterval / (q ? 5 : 1) * (n - f) / ((q ? E / v.tickPositions.length : E) || 1)), a = D(a, void 0, y(a)), t = v.getLinearTickPositions(a, f, n).map(this.log2lin),
                        q || (this.minorAutoInterval = a / 5);
                    q || (v.tickInterval = a);
                    return t
                };
                a.prototype.lin2log = function (a) {
                    return Math.pow(10, a)
                };
                a.prototype.log2lin = function (a) {
                    return Math.log(a) / Math.LN10
                };
                return a
            }();
        a = function () {
            function a() {}
            a.compose = function (a) {
                a.keepProps.push("logarithmic");
                var f = a.prototype,
                    H = C.prototype;
                f.log2lin = H.log2lin;
                f.lin2log = H.lin2log;
                n(a, "init", function (a) {
                    var f = this.logarithmic;
                    "logarithmic" !== a.userOptions.type ? this.logarithmic = void 0 : (f || (f = this.logarithmic = new C(this)), this.log2lin !==
                        f.log2lin && (f.log2lin = this.log2lin.bind(this)), this.lin2log !== f.lin2log && (f.lin2log = this.lin2log.bind(this)))
                });
                n(a, "afterInit", function () {
                    var a = this.logarithmic;
                    a && (this.lin2val = function (f) {
                        return a.lin2log(f)
                    }, this.val2lin = function (f) {
                        return a.log2lin(f)
                    })
                })
            };
            return a
        }();
        a.compose(f);
        return a
    });
    O(n, "Core/Axis/PlotLineOrBand.js", [n["Core/Axis/Axis.js"], n["Core/Globals.js"], n["Core/Utilities.js"]], function (f, a, n) {
        var y = n.arrayMax,
            D = n.arrayMin,
            G = n.defined,
            C = n.destroyObjectProperties,
            J = n.erase,
            H = n.extend,
            v = n.merge,
            L = n.objectEach,
            q = n.pick,
            K = function () {
                function f(a, f) {
                    this.axis = a;
                    f && (this.options = f, this.id = f.id)
                }
                f.prototype.render = function () {
                    a.fireEvent(this, "render");
                    var f = this,
                        t = f.axis,
                        I = t.horiz,
                        u = t.logarithmic,
                        m = f.options,
                        h = m.label,
                        l = f.label,
                        k = m.to,
                        g = m.from,
                        d = m.value,
                        x = G(g) && G(k),
                        r = G(d),
                        A = f.svgElem,
                        N = !A,
                        B = [],
                        M = m.color,
                        R = q(m.zIndex, 0),
                        F = m.events;
                    B = {
                        "class": "highcharts-plot-" + (x ? "band " : "line ") + (m.className || "")
                    };
                    var e = {},
                        c = t.chart.renderer,
                        b = x ? "bands" : "lines";
                    u && (g = u.log2lin(g), k = u.log2lin(k), d =
                        u.log2lin(d));
                    t.chart.styledMode || (r ? (B.stroke = M || "#999999", B["stroke-width"] = q(m.width, 1), m.dashStyle && (B.dashstyle = m.dashStyle)) : x && (B.fill = M || "#e6ebf5", m.borderWidth && (B.stroke = m.borderColor, B["stroke-width"] = m.borderWidth)));
                    e.zIndex = R;
                    b += "-" + R;
                    (u = t.plotLinesAndBandsGroups[b]) || (t.plotLinesAndBandsGroups[b] = u = c.g("plot-" + b).attr(e).add());
                    N && (f.svgElem = A = c.path().attr(B).add(u));
                    if (r) B = t.getPlotLinePath({
                        value: d,
                        lineWidth: A.strokeWidth(),
                        acrossPanes: m.acrossPanes
                    });
                    else if (x) B = t.getPlotBandPath(g,
                        k, m);
                    else return;
                    !f.eventsAdded && F && (L(F, function (b, c) {
                        A.on(c, function (b) {
                            F[c].apply(f, [b])
                        })
                    }), f.eventsAdded = !0);
                    (N || !A.d) && B && B.length ? A.attr({
                        d: B
                    }) : A && (B ? (A.show(!0), A.animate({
                        d: B
                    })) : A.d && (A.hide(), l && (f.label = l = l.destroy())));
                    h && (G(h.text) || G(h.formatter)) && B && B.length && 0 < t.width && 0 < t.height && !B.isFlat ? (h = v({
                        align: I && x && "center",
                        x: I ? !x && 4 : 10,
                        verticalAlign: !I && x && "middle",
                        y: I ? x ? 16 : 10 : x ? 6 : -4,
                        rotation: I && !x && 90
                    }, h), this.renderLabel(h, B, x, R)) : l && l.hide();
                    return f
                };
                f.prototype.renderLabel = function (a,
                    f, q, u) {
                    var m = this.label,
                        h = this.axis.chart.renderer;
                    m || (m = {
                        align: a.textAlign || a.align,
                        rotation: a.rotation,
                        "class": "highcharts-plot-" + (q ? "band" : "line") + "-label " + (a.className || "")
                    }, m.zIndex = u, u = this.getLabelText(a), this.label = m = h.text(u, 0, 0, a.useHTML).attr(m).add(), this.axis.chart.styledMode || m.css(a.style));
                    h = f.xBounds || [f[0][1], f[1][1], q ? f[2][1] : f[0][1]];
                    f = f.yBounds || [f[0][2], f[1][2], q ? f[2][2] : f[0][2]];
                    q = D(h);
                    u = D(f);
                    m.align(a, !1, {
                        x: q,
                        y: u,
                        width: y(h) - q,
                        height: y(f) - u
                    });
                    m.show(!0)
                };
                f.prototype.getLabelText =
                    function (a) {
                        return G(a.formatter) ? a.formatter.call(this) : a.text
                    };
                f.prototype.destroy = function () {
                    J(this.axis.plotLinesAndBands, this);
                    delete this.axis;
                    C(this)
                };
                return f
            }();
        H(f.prototype, {
            getPlotBandPath: function (a, f) {
                var p = this.getPlotLinePath({
                        value: f,
                        force: !0,
                        acrossPanes: this.options.acrossPanes
                    }),
                    q = this.getPlotLinePath({
                        value: a,
                        force: !0,
                        acrossPanes: this.options.acrossPanes
                    }),
                    u = [],
                    m = this.horiz,
                    h = 1;
                a = a < this.min && f < this.min || a > this.max && f > this.max;
                if (q && p) {
                    if (a) {
                        var l = q.toString() === p.toString();
                        h =
                            0
                    }
                    for (a = 0; a < q.length; a += 2) {
                        f = q[a];
                        var k = q[a + 1],
                            g = p[a],
                            d = p[a + 1];
                        "M" !== f[0] && "L" !== f[0] || "M" !== k[0] && "L" !== k[0] || "M" !== g[0] && "L" !== g[0] || "M" !== d[0] && "L" !== d[0] || (m && g[1] === f[1] ? (g[1] += h, d[1] += h) : m || g[2] !== f[2] || (g[2] += h, d[2] += h), u.push(["M", f[1], f[2]], ["L", k[1], k[2]], ["L", d[1], d[2]], ["L", g[1], g[2]], ["Z"]));
                        u.isFlat = l
                    }
                }
                return u
            },
            addPlotBand: function (a) {
                return this.addPlotBandOrLine(a, "plotBands")
            },
            addPlotLine: function (a) {
                return this.addPlotBandOrLine(a, "plotLines")
            },
            addPlotBandOrLine: function (a, f) {
                var p =
                    (new K(this, a)).render(),
                    q = this.userOptions;
                if (p) {
                    if (f) {
                        var u = q[f] || [];
                        u.push(a);
                        q[f] = u
                    }
                    this.plotLinesAndBands.push(p);
                    this._addedPlotLB = !0
                }
                return p
            },
            removePlotBandOrLine: function (a) {
                for (var f = this.plotLinesAndBands, t = this.options, q = this.userOptions, u = f.length; u--;) f[u].id === a && f[u].destroy();
                [t.plotLines || [], q.plotLines || [], t.plotBands || [], q.plotBands || []].forEach(function (f) {
                    for (u = f.length; u--;)(f[u] || {}).id === a && J(f, f[u])
                })
            },
            removePlotBand: function (a) {
                this.removePlotBandOrLine(a)
            },
            removePlotLine: function (a) {
                this.removePlotBandOrLine(a)
            }
        });
        a.PlotLineOrBand = K;
        return a.PlotLineOrBand
    });
    O(n, "Core/Tooltip.js", [n["Core/Globals.js"], n["Core/Utilities.js"]], function (f, a) {
        var n = f.doc,
            y = a.clamp,
            D = a.css,
            G = a.defined,
            C = a.discardElement,
            J = a.extend,
            H = a.fireEvent,
            v = a.format,
            L = a.isNumber,
            q = a.isString,
            K = a.merge,
            E = a.pick,
            p = a.splat,
            t = a.syncTimeout,
            I = a.timeUnits;
        "";
        var u = function () {
            function m(h, a) {
                this.container = void 0;
                this.crosshairs = [];
                this.distance = 0;
                this.isHidden = !0;
                this.isSticky = !1;
                this.now = {};
                this.options = {};
                this.outside = !1;
                this.chart = h;
                this.init(h,
                    a)
            }
            m.prototype.applyFilter = function () {
                var h = this.chart;
                h.renderer.definition({
                    tagName: "filter",
                    id: "drop-shadow-" + h.index,
                    opacity: .5,
                    children: [{
                        tagName: "feGaussianBlur",
                        "in": "SourceAlpha",
                        stdDeviation: 1
                    }, {
                        tagName: "feOffset",
                        dx: 1,
                        dy: 1
                    }, {
                        tagName: "feComponentTransfer",
                        children: [{
                            tagName: "feFuncA",
                            type: "linear",
                            slope: .3
                        }]
                    }, {
                        tagName: "feMerge",
                        children: [{
                            tagName: "feMergeNode"
                        }, {
                            tagName: "feMergeNode",
                            "in": "SourceGraphic"
                        }]
                    }]
                });
                h.renderer.definition({
                    tagName: "style",
                    textContent: ".highcharts-tooltip-" + h.index +
                        "{filter:url(#drop-shadow-" + h.index + ")}"
                })
            };
            m.prototype.bodyFormatter = function (h) {
                return h.map(function (h) {
                    var k = h.series.tooltipOptions;
                    return (k[(h.point.formatPrefix || "point") + "Formatter"] || h.point.tooltipFormatter).call(h.point, k[(h.point.formatPrefix || "point") + "Format"] || "")
                })
            };
            m.prototype.cleanSplit = function (h) {
                this.chart.series.forEach(function (a) {
                    var k = a && a.tt;
                    k && (!k.isActive || h ? a.tt = k.destroy() : k.isActive = !1)
                })
            };
            m.prototype.defaultFormatter = function (h) {
                var a = this.points || p(this);
                var k = [h.tooltipFooterHeaderFormatter(a[0])];
                k = k.concat(h.bodyFormatter(a));
                k.push(h.tooltipFooterHeaderFormatter(a[0], !0));
                return k
            };
            m.prototype.destroy = function () {
                this.label && (this.label = this.label.destroy());
                this.split && this.tt && (this.cleanSplit(this.chart, !0), this.tt = this.tt.destroy());
                this.renderer && (this.renderer = this.renderer.destroy(), C(this.container));
                a.clearTimeout(this.hideTimer);
                a.clearTimeout(this.tooltipTimeout)
            };
            m.prototype.getAnchor = function (h, a) {
                var k = this.chart,
                    g = k.pointer,
                    d = k.inverted,
                    l = k.plotTop,
                    f = k.plotLeft,
                    m = 0,
                    t = 0,
                    B, M;
                h = p(h);
                this.followPointer && a ? ("undefined" === typeof a.chartX && (a = g.normalize(a)), h = [a.chartX - f, a.chartY - l]) : h[0].tooltipPos ? h = h[0].tooltipPos : (h.forEach(function (g) {
                    B = g.series.yAxis;
                    M = g.series.xAxis;
                    m += g.plotX + (!d && M ? M.left - f : 0);
                    t += (g.plotLow ? (g.plotLow + g.plotHigh) / 2 : g.plotY) + (!d && B ? B.top - l : 0)
                }), m /= h.length, t /= h.length, h = [d ? k.plotWidth - t : m, this.shared && !d && 1 < h.length && a ? a.chartY - l : d ? k.plotHeight - m : t]);
                return h.map(Math.round)
            };
            m.prototype.getDateFormat = function (h, a, k, g) {
                var d = this.chart.time,
                    l = d.dateFormat("%m-%d %H:%M:%S.%L",
                        a),
                    f = {
                        millisecond: 15,
                        second: 12,
                        minute: 9,
                        hour: 6,
                        day: 3
                    },
                    m = "millisecond";
                for (p in I) {
                    if (h === I.week && +d.dateFormat("%w", a) === k && "00:00:00.000" === l.substr(6)) {
                        var p = "week";
                        break
                    }
                    if (I[p] > h) {
                        p = m;
                        break
                    }
                    if (f[p] && l.substr(f[p]) !== "01-01 00:00:00.000".substr(f[p])) break;
                    "week" !== p && (m = p)
                }
                if (p) var B = d.resolveDTLFormat(g[p]).main;
                return B
            };
            m.prototype.getLabel = function () {
                var h, a, k = this,
                    g = this.chart.renderer,
                    d = this.chart.styledMode,
                    m = this.options,
                    r = "tooltip" + (G(m.className) ? " " + m.className : ""),
                    p = (null === (h = m.style) ||
                        void 0 === h ? void 0 : h.pointerEvents) || (!this.followPointer && m.stickOnContact ? "auto" : "none"),
                    t;
                h = function () {
                    k.inContact = !0
                };
                var B = function () {
                    var e = k.chart.hoverSeries;
                    k.inContact = !1;
                    if (e && e.onMouseOut) e.onMouseOut()
                };
                if (!this.label) {
                    this.outside && (this.container = t = f.doc.createElement("div"), t.className = "highcharts-tooltip-container", D(t, {
                        position: "absolute",
                        top: "1px",
                        pointerEvents: p,
                        zIndex: 3
                    }), f.doc.body.appendChild(t), this.renderer = g = new f.Renderer(t, 0, 0, null === (a = this.chart.options.chart) || void 0 ===
                        a ? void 0 : a.style, void 0, void 0, g.styledMode));
                    this.split ? this.label = g.g(r) : (this.label = g.label("", 0, 0, m.shape || "callout", null, null, m.useHTML, null, r).attr({
                        padding: m.padding,
                        r: m.borderRadius
                    }), d || this.label.attr({
                        fill: m.backgroundColor,
                        "stroke-width": m.borderWidth
                    }).css(m.style).css({
                        pointerEvents: p
                    }).shadow(m.shadow));
                    d && (this.applyFilter(), this.label.addClass("highcharts-tooltip-" + this.chart.index));
                    if (k.outside && !k.split) {
                        var M = this.label,
                            q = M.xSetter,
                            F = M.ySetter;
                        M.xSetter = function (e) {
                            q.call(M, k.distance);
                            t.style.left = e + "px"
                        };
                        M.ySetter = function (e) {
                            F.call(M, k.distance);
                            t.style.top = e + "px"
                        }
                    }
                    this.label.on("mouseenter", h).on("mouseleave", B).attr({
                        zIndex: 8
                    }).add()
                }
                return this.label
            };
            m.prototype.getPosition = function (a, l, k) {
                var g = this.chart,
                    d = this.distance,
                    h = {},
                    f = g.inverted && k.h || 0,
                    m, p = this.outside,
                    B = p ? n.documentElement.clientWidth - 2 * d : g.chartWidth,
                    M = p ? Math.max(n.body.scrollHeight, n.documentElement.scrollHeight, n.body.offsetHeight, n.documentElement.offsetHeight, n.documentElement.clientHeight) : g.chartHeight,
                    t = g.pointer.getChartPosition(),
                    F = g.containerScaling,
                    e = function (b) {
                        return F ? b * F.scaleX : b
                    },
                    c = function (b) {
                        return F ? b * F.scaleY : b
                    },
                    b = function (b) {
                        var h = "x" === b;
                        return [b, h ? B : M, h ? a : l].concat(p ? [h ? e(a) : c(l), h ? t.left - d + e(k.plotX + g.plotLeft) : t.top - d + c(k.plotY + g.plotTop), 0, h ? B : M] : [h ? a : l, h ? k.plotX + g.plotLeft : k.plotY + g.plotTop, h ? g.plotLeft : g.plotTop, h ? g.plotLeft + g.plotWidth : g.plotTop + g.plotHeight])
                    },
                    z = b("y"),
                    w = b("x"),
                    q = !this.followPointer && E(k.ttBelow, !g.inverted === !!k.negative),
                    u = function (b, g, k, a, l, m, r) {
                        var x =
                            "y" === b ? c(d) : e(d),
                            w = (k - a) / 2,
                            p = a < l - d,
                            B = l + d + a < g,
                            z = l - x - k + w;
                        l = l + x - w;
                        if (q && B) h[b] = l;
                        else if (!q && p) h[b] = z;
                        else if (p) h[b] = Math.min(r - a, 0 > z - f ? z : z - f);
                        else if (B) h[b] = Math.max(m, l + f + k > g ? l : l + f);
                        else return !1
                    },
                    v = function (b, c, e, g, k) {
                        var a;
                        k < d || k > c - d ? a = !1 : h[b] = k < e / 2 ? 1 : k > c - g / 2 ? c - g - 2 : k - e / 2;
                        return a
                    },
                    I = function (b) {
                        var c = z;
                        z = w;
                        w = c;
                        m = b
                    },
                    H = function () {
                        !1 !== u.apply(0, z) ? !1 !== v.apply(0, w) || m || (I(!0), H()) : m ? h.x = h.y = 0 : (I(!0), H())
                    };
                (g.inverted || 1 < this.len) && I();
                H();
                return h
            };
            m.prototype.getXDateFormat = function (a, l, k) {
                l = l.dateTimeLabelFormats;
                var g = k && k.closestPointRange;
                return (g ? this.getDateFormat(g, a.x, k.options.startOfWeek, l) : l.day) || l.year
            };
            m.prototype.hide = function (h) {
                var l = this;
                a.clearTimeout(this.hideTimer);
                h = E(h, this.options.hideDelay, 500);
                this.isHidden || (this.hideTimer = t(function () {
                    l.getLabel().fadeOut(h ? void 0 : h);
                    l.isHidden = !0
                }, h))
            };
            m.prototype.init = function (a, l) {
                this.chart = a;
                this.options = l;
                this.crosshairs = [];
                this.now = {
                    x: 0,
                    y: 0
                };
                this.isHidden = !0;
                this.split = l.split && !a.inverted && !a.polar;
                this.shared = l.shared || this.split;
                this.outside =
                    E(l.outside, !(!a.scrollablePixelsX && !a.scrollablePixelsY))
            };
            m.prototype.isStickyOnContact = function () {
                return !(this.followPointer || !this.options.stickOnContact || !this.inContact)
            };
            m.prototype.move = function (h, l, k, g) {
                var d = this,
                    f = d.now,
                    m = !1 !== d.options.animation && !d.isHidden && (1 < Math.abs(h - f.x) || 1 < Math.abs(l - f.y)),
                    p = d.followPointer || 1 < d.len;
                J(f, {
                    x: m ? (2 * f.x + h) / 3 : h,
                    y: m ? (f.y + l) / 2 : l,
                    anchorX: p ? void 0 : m ? (2 * f.anchorX + k) / 3 : k,
                    anchorY: p ? void 0 : m ? (f.anchorY + g) / 2 : g
                });
                d.getLabel().attr(f);
                d.drawTracker();
                m && (a.clearTimeout(this.tooltipTimeout),
                    this.tooltipTimeout = setTimeout(function () {
                        d && d.move(h, l, k, g)
                    }, 32))
            };
            m.prototype.refresh = function (h, l) {
                var k = this.chart,
                    g = this.options,
                    d = h,
                    f = {},
                    m = [],
                    A = g.formatter || this.defaultFormatter;
                f = this.shared;
                var t = k.styledMode;
                if (g.enabled) {
                    a.clearTimeout(this.hideTimer);
                    this.followPointer = p(d)[0].series.tooltipOptions.followPointer;
                    var B = this.getAnchor(d, l);
                    l = B[0];
                    var M = B[1];
                    !f || d.series && d.series.noSharedTooltip ? f = d.getLabelConfig() : (k.pointer.applyInactiveState(d), d.forEach(function (d) {
                        d.setState("hover");
                        m.push(d.getLabelConfig())
                    }), f = {
                        x: d[0].category,
                        y: d[0].y
                    }, f.points = m, d = d[0]);
                    this.len = m.length;
                    k = A.call(f, this);
                    A = d.series;
                    this.distance = E(A.tooltipOptions.distance, 16);
                    !1 === k ? this.hide() : (this.split ? this.renderSplit(k, p(h)) : (h = this.getLabel(), g.style.width && !t || h.css({
                            width: this.chart.spacingBox.width + "px"
                        }), h.attr({
                            text: k && k.join ? k.join("") : k
                        }), h.removeClass(/highcharts-color-[\d]+/g).addClass("highcharts-color-" + E(d.colorIndex, A.colorIndex)), t || h.attr({
                            stroke: g.borderColor || d.color || A.color || "#666666"
                        }),
                        this.updatePosition({
                            plotX: l,
                            plotY: M,
                            negative: d.negative,
                            ttBelow: d.ttBelow,
                            h: B[2] || 0
                        })), this.isHidden && this.label && this.label.attr({
                        opacity: 1
                    }).show(), this.isHidden = !1);
                    H(this, "refresh")
                }
            };
            m.prototype.renderSplit = function (a, l) {
                function k(b, c, e, d, g) {
                    void 0 === g && (g = !0);
                    e ? (c = H ? 0 : G, b = y(b - d / 2, n.left, n.right - d)) : (c -= K, b = g ? b - d - z : b + z, b = y(b, g ? b : n.left, n.right));
                    return {
                        x: b,
                        y: c
                    }
                }
                var g = this,
                    d = g.chart,
                    h = g.chart,
                    m = h.plotHeight,
                    p = h.plotLeft,
                    t = h.plotTop,
                    B = h.pointer,
                    M = h.renderer,
                    u = h.scrollablePixelsY,
                    F = void 0 === u ?
                    0 : u;
                u = h.scrollingContainer;
                u = void 0 === u ? {
                    scrollLeft: 0,
                    scrollTop: 0
                } : u;
                var e = u.scrollLeft,
                    c = u.scrollTop,
                    b = h.styledMode,
                    z = g.distance,
                    w = g.options,
                    v = g.options.positioner,
                    n = {
                        left: e,
                        right: e + h.chartWidth,
                        top: c,
                        bottom: c + h.chartHeight
                    },
                    I = g.getLabel(),
                    H = !(!d.xAxis[0] || !d.xAxis[0].opposite),
                    K = t + c,
                    C = 0,
                    G = m - F;
                q(a) && (a = [!1, a]);
                a = a.slice(0, l.length + 1).reduce(function (e, d, a) {
                    if (!1 !== d && "" !== d) {
                        a = l[a - 1] || {
                            isHeader: !0,
                            plotX: l[0].plotX,
                            plotY: m,
                            series: {}
                        };
                        var h = a.isHeader,
                            f = h ? g : a.series,
                            r = f.tt,
                            x = a.isHeader;
                        var B = a.series;
                        var A = "highcharts-color-" + E(a.colorIndex, B.colorIndex, "none");
                        r || (r = {
                            padding: w.padding,
                            r: w.borderRadius
                        }, b || (r.fill = w.backgroundColor, r["stroke-width"] = w.borderWidth), r = M.label("", 0, 0, w[x ? "headerShape" : "shape"] || "callout", void 0, void 0, w.useHTML).addClass((x ? "highcharts-tooltip-header " : "") + "highcharts-tooltip-box " + A).attr(r).add(I));
                        r.isActive = !0;
                        r.attr({
                            text: d
                        });
                        b || r.css(w.style).shadow(w.shadow).attr({
                            stroke: w.borderColor || a.color || B.color || "#333333"
                        });
                        d = f.tt = r;
                        x = d.getBBox();
                        f = x.width + d.strokeWidth();
                        h && (C = x.height, G += C, H && (K -= C));
                        B = a.plotX;
                        B = void 0 === B ? 0 : B;
                        A = a.plotY;
                        A = void 0 === A ? 0 : A;
                        var Q = a.series;
                        if (a.isHeader) {
                            B = p + B;
                            var u = t + m / 2
                        } else r = Q.xAxis, Q = Q.yAxis, B = r.pos + y(B, -z, r.len + z), Q.pos + A >= c + t && Q.pos + A <= c + t + m - F && (u = Q.pos + A);
                        B = y(B, n.left - z, n.right + z);
                        "number" === typeof u ? (x = x.height + 1, A = v ? v.call(g, f, x, a) : k(B, u, h, f), e.push({
                            align: v ? 0 : void 0,
                            anchorX: B,
                            anchorY: u,
                            boxWidth: f,
                            point: a,
                            rank: E(A.rank, h ? 1 : 0),
                            size: x,
                            target: A.y,
                            tt: d,
                            x: A.x
                        })) : d.isActive = !1
                    }
                    return e
                }, []);
                !v && a.some(function (b) {
                        return b.x < n.left
                    }) &&
                    (a = a.map(function (b) {
                        var c = k(b.anchorX, b.anchorY, b.point.isHeader, b.boxWidth, !1);
                        return J(b, {
                            target: c.y,
                            x: c.x
                        })
                    }));
                g.cleanSplit();
                f.distribute(a, G);
                a.forEach(function (b) {
                    var c = b.pos;
                    b.tt.attr({
                        visibility: "undefined" === typeof c ? "hidden" : "inherit",
                        x: b.x,
                        y: c + K,
                        anchorX: b.anchorX,
                        anchorY: b.anchorY
                    })
                });
                a = g.container;
                d = g.renderer;
                g.outside && a && d && (h = I.getBBox(), d.setSize(h.width + h.x, h.height + h.y, !1), B = B.getChartPosition(), a.style.left = B.left + "px", a.style.top = B.top + "px")
            };
            m.prototype.drawTracker = function () {
                if (this.followPointer ||
                    !this.options.stickOnContact) this.tracker && this.tracker.destroy();
                else {
                    var a = this.chart,
                        l = this.label,
                        k = a.hoverPoint;
                    if (l && k) {
                        var g = {
                            x: 0,
                            y: 0,
                            width: 0,
                            height: 0
                        };
                        k = this.getAnchor(k);
                        var d = l.getBBox();
                        k[0] += a.plotLeft - l.translateX;
                        k[1] += a.plotTop - l.translateY;
                        g.x = Math.min(0, k[0]);
                        g.y = Math.min(0, k[1]);
                        g.width = 0 > k[0] ? Math.max(Math.abs(k[0]), d.width - k[0]) : Math.max(Math.abs(k[0]), d.width);
                        g.height = 0 > k[1] ? Math.max(Math.abs(k[1]), d.height - Math.abs(k[1])) : Math.max(Math.abs(k[1]), d.height);
                        this.tracker ? this.tracker.attr(g) :
                            (this.tracker = l.renderer.rect(g).addClass("highcharts-tracker").add(l), a.styledMode || this.tracker.attr({
                                fill: "rgba(0,0,0,0)"
                            }))
                    }
                }
            };
            m.prototype.styledModeFormat = function (a) {
                return a.replace('style="font-size: 10px"', 'class="highcharts-header"').replace(/style="color:{(point|series)\.color}"/g, 'class="highcharts-color-{$1.colorIndex}"')
            };
            m.prototype.tooltipFooterHeaderFormatter = function (a, l) {
                var k = l ? "footer" : "header",
                    g = a.series,
                    d = g.tooltipOptions,
                    h = d.xDateFormat,
                    f = g.xAxis,
                    m = f && "datetime" === f.options.type &&
                    L(a.key),
                    p = d[k + "Format"];
                l = {
                    isFooter: l,
                    labelConfig: a
                };
                H(this, "headerFormatter", l, function (k) {
                    m && !h && (h = this.getXDateFormat(a, d, f));
                    m && h && (a.point && a.point.tooltipDateKeys || ["key"]).forEach(function (d) {
                        p = p.replace("{point." + d + "}", "{point." + d + ":" + h + "}")
                    });
                    g.chart.styledMode && (p = this.styledModeFormat(p));
                    k.text = v(p, {
                        point: a,
                        series: g
                    }, this.chart)
                });
                return l.text
            };
            m.prototype.update = function (a) {
                this.destroy();
                K(!0, this.chart.options.tooltip.userOptions, a);
                this.init(this.chart, K(!0, this.options, a))
            };
            m.prototype.updatePosition =
                function (a) {
                    var h = this.chart,
                        k = h.pointer,
                        g = this.getLabel(),
                        d = a.plotX + h.plotLeft,
                        f = a.plotY + h.plotTop;
                    k = k.getChartPosition();
                    a = (this.options.positioner || this.getPosition).call(this, g.width, g.height, a);
                    if (this.outside) {
                        var m = (this.options.borderWidth || 0) + 2 * this.distance;
                        this.renderer.setSize(g.width + m, g.height + m, !1);
                        if (h = h.containerScaling) D(this.container, {
                            transform: "scale(" + h.scaleX + ", " + h.scaleY + ")"
                        }), d *= h.scaleX, f *= h.scaleY;
                        d += k.left - a.x;
                        f += k.top - a.y
                    }
                    this.move(Math.round(a.x), Math.round(a.y || 0),
                        d, f)
                };
            return m
        }();
        f.Tooltip = u;
        return f.Tooltip
    });
    O(n, "Core/Pointer.js", [n["Core/Color.js"], n["Core/Globals.js"], n["Core/Tooltip.js"], n["Core/Utilities.js"]], function (f, a, n, y) {
        var D = f.parse,
            G = a.charts,
            C = a.noop,
            J = y.addEvent,
            H = y.attr,
            v = y.css,
            L = y.defined,
            q = y.extend,
            K = y.find,
            E = y.fireEvent,
            p = y.isNumber,
            t = y.isObject,
            I = y.objectEach,
            u = y.offset,
            m = y.pick,
            h = y.splat;
        "";
        f = function () {
            function l(a, g) {
                this.lastValidTouch = {};
                this.pinchDown = [];
                this.runChartClick = !1;
                this.chart = a;
                this.hasDragged = !1;
                this.options = g;
                this.unbindContainerMouseLeave =
                    function () {};
                this.unbindContainerMouseEnter = function () {};
                this.init(a, g)
            }
            l.prototype.applyInactiveState = function (a) {
                var g = [],
                    d;
                (a || []).forEach(function (a) {
                    d = a.series;
                    g.push(d);
                    d.linkedParent && g.push(d.linkedParent);
                    d.linkedSeries && (g = g.concat(d.linkedSeries));
                    d.navigatorSeries && g.push(d.navigatorSeries)
                });
                this.chart.series.forEach(function (d) {
                    -1 === g.indexOf(d) ? d.setState("inactive", !0) : d.options.inactiveOtherPoints && d.setAllPointsToState("inactive")
                })
            };
            l.prototype.destroy = function () {
                var k = this;
                "undefined" !==
                typeof k.unDocMouseMove && k.unDocMouseMove();
                this.unbindContainerMouseLeave();
                a.chartCount || (a.unbindDocumentMouseUp && (a.unbindDocumentMouseUp = a.unbindDocumentMouseUp()), a.unbindDocumentTouchEnd && (a.unbindDocumentTouchEnd = a.unbindDocumentTouchEnd()));
                clearInterval(k.tooltipTimeout);
                I(k, function (g, d) {
                    k[d] = void 0
                })
            };
            l.prototype.drag = function (a) {
                var g = this.chart,
                    d = g.options.chart,
                    k = a.chartX,
                    h = a.chartY,
                    l = this.zoomHor,
                    f = this.zoomVert,
                    m = g.plotLeft,
                    p = g.plotTop,
                    u = g.plotWidth,
                    F = g.plotHeight,
                    e = this.selectionMarker,
                    c = this.mouseDownX || 0,
                    b = this.mouseDownY || 0,
                    z = t(d.panning) ? d.panning && d.panning.enabled : d.panning,
                    w = d.panKey && a[d.panKey + "Key"];
                if (!e || !e.touch)
                    if (k < m ? k = m : k > m + u && (k = m + u), h < p ? h = p : h > p + F && (h = p + F), this.hasDragged = Math.sqrt(Math.pow(c - k, 2) + Math.pow(b - h, 2)), 10 < this.hasDragged) {
                        var q = g.isInsidePlot(c - m, b - p);
                        g.hasCartesianSeries && (this.zoomX || this.zoomY) && q && !w && !e && (this.selectionMarker = e = g.renderer.rect(m, p, l ? 1 : u, f ? 1 : F, 0).attr({
                            "class": "highcharts-selection-marker",
                            zIndex: 7
                        }).add(), g.styledMode || e.attr({
                            fill: d.selectionMarkerFill ||
                                D("#335cad").setOpacity(.25).get()
                        }));
                        e && l && (k -= c, e.attr({
                            width: Math.abs(k),
                            x: (0 < k ? 0 : k) + c
                        }));
                        e && f && (k = h - b, e.attr({
                            height: Math.abs(k),
                            y: (0 < k ? 0 : k) + b
                        }));
                        q && !e && z && g.pan(a, d.panning)
                    }
            };
            l.prototype.dragStart = function (a) {
                var g = this.chart;
                g.mouseIsDown = a.type;
                g.cancelClick = !1;
                g.mouseDownX = this.mouseDownX = a.chartX;
                g.mouseDownY = this.mouseDownY = a.chartY
            };
            l.prototype.drop = function (a) {
                var g = this,
                    d = this.chart,
                    k = this.hasPinched;
                if (this.selectionMarker) {
                    var h = {
                            originalEvent: a,
                            xAxis: [],
                            yAxis: []
                        },
                        l = this.selectionMarker,
                        f = l.attr ? l.attr("x") : l.x,
                        m = l.attr ? l.attr("y") : l.y,
                        t = l.attr ? l.attr("width") : l.width,
                        u = l.attr ? l.attr("height") : l.height,
                        F;
                    if (this.hasDragged || k) d.axes.forEach(function (e) {
                        if (e.zoomEnabled && L(e.min) && (k || g[{
                                xAxis: "zoomX",
                                yAxis: "zoomY"
                            } [e.coll]]) && p(f) && p(m)) {
                            var c = e.horiz,
                                b = "touchend" === a.type ? e.minPixelPadding : 0,
                                d = e.toValue((c ? f : m) + b);
                            c = e.toValue((c ? f + t : m + u) - b);
                            h[e.coll].push({
                                axis: e,
                                min: Math.min(d, c),
                                max: Math.max(d, c)
                            });
                            F = !0
                        }
                    }), F && E(d, "selection", h, function (e) {
                        d.zoom(q(e, k ? {
                            animation: !1
                        } : null))
                    });
                    p(d.index) && (this.selectionMarker = this.selectionMarker.destroy());
                    k && this.scaleGroups()
                }
                d && p(d.index) && (v(d.container, {
                    cursor: d._cursor
                }), d.cancelClick = 10 < this.hasDragged, d.mouseIsDown = this.hasDragged = this.hasPinched = !1, this.pinchDown = [])
            };
            l.prototype.findNearestKDPoint = function (a, g, d) {
                var k = this.chart,
                    h = k.hoverPoint;
                k = k.tooltip;
                if (h && k && k.isStickyOnContact()) return h;
                var l;
                a.forEach(function (a) {
                    var k = !(a.noSharedTooltip && g) && 0 > a.options.findNearestPointBy.indexOf("y");
                    a = a.searchPoint(d, k);
                    if ((k =
                            t(a, !0)) && !(k = !t(l, !0))) {
                        k = l.distX - a.distX;
                        var h = l.dist - a.dist,
                            f = (a.series.group && a.series.group.zIndex) - (l.series.group && l.series.group.zIndex);
                        k = 0 < (0 !== k && g ? k : 0 !== h ? h : 0 !== f ? f : l.series.index > a.series.index ? -1 : 1)
                    }
                    k && (l = a)
                });
                return l
            };
            l.prototype.getChartCoordinatesFromPoint = function (a, g) {
                var d = a.series,
                    k = d.xAxis;
                d = d.yAxis;
                var h = m(a.clientX, a.plotX),
                    l = a.shapeArgs;
                if (k && d) return g ? {
                    chartX: k.len + k.pos - h,
                    chartY: d.len + d.pos - a.plotY
                } : {
                    chartX: h + k.pos,
                    chartY: a.plotY + d.pos
                };
                if (l && l.x && l.y) return {
                    chartX: l.x,
                    chartY: l.y
                }
            };
            l.prototype.getChartPosition = function () {
                return this.chartPosition || (this.chartPosition = u(this.chart.container))
            };
            l.prototype.getCoordinates = function (a) {
                var g = {
                    xAxis: [],
                    yAxis: []
                };
                this.chart.axes.forEach(function (d) {
                    g[d.isXAxis ? "xAxis" : "yAxis"].push({
                        axis: d,
                        value: d.toValue(a[d.horiz ? "chartX" : "chartY"])
                    })
                });
                return g
            };
            l.prototype.getHoverData = function (a, g, d, h, l, f) {
                var k, r = [];
                h = !(!h || !a);
                var p = g && !g.stickyTracking,
                    x = {
                        chartX: f ? f.chartX : void 0,
                        chartY: f ? f.chartY : void 0,
                        shared: l
                    };
                E(this, "beforeGetHoverData",
                    x);
                p = p ? [g] : d.filter(function (d) {
                    return x.filter ? x.filter(d) : d.visible && !(!l && d.directTouch) && m(d.options.enableMouseTracking, !0) && d.stickyTracking
                });
                g = (k = h || !f ? a : this.findNearestKDPoint(p, l, f)) && k.series;
                k && (l && !g.noSharedTooltip ? (p = d.filter(function (d) {
                        return x.filter ? x.filter(d) : d.visible && !(!l && d.directTouch) && m(d.options.enableMouseTracking, !0) && !d.noSharedTooltip
                    }), p.forEach(function (d) {
                        var e = K(d.points, function (c) {
                            return c.x === k.x && !c.isNull
                        });
                        t(e) && (d.chart.isBoosting && (e = d.getPoint(e)), r.push(e))
                    })) :
                    r.push(k));
                x = {
                    hoverPoint: k
                };
                E(this, "afterGetHoverData", x);
                return {
                    hoverPoint: x.hoverPoint,
                    hoverSeries: g,
                    hoverPoints: r
                }
            };
            l.prototype.getPointFromEvent = function (a) {
                a = a.target;
                for (var g; a && !g;) g = a.point, a = a.parentNode;
                return g
            };
            l.prototype.onTrackerMouseOut = function (a) {
                a = a.relatedTarget || a.toElement;
                var g = this.chart.hoverSeries;
                this.isDirectTouch = !1;
                if (!(!g || !a || g.stickyTracking || this.inClass(a, "highcharts-tooltip") || this.inClass(a, "highcharts-series-" + g.index) && this.inClass(a, "highcharts-tracker"))) g.onMouseOut()
            };
            l.prototype.inClass = function (a, g) {
                for (var d; a;) {
                    if (d = H(a, "class")) {
                        if (-1 !== d.indexOf(g)) return !0;
                        if (-1 !== d.indexOf("highcharts-container")) return !1
                    }
                    a = a.parentNode
                }
            };
            l.prototype.init = function (a, g) {
                this.options = g;
                this.chart = a;
                this.runChartClick = g.chart.events && !!g.chart.events.click;
                this.pinchDown = [];
                this.lastValidTouch = {};
                n && (a.tooltip = new n(a, g.tooltip), this.followTouchMove = m(g.tooltip.followTouchMove, !0));
                this.setDOMEvents()
            };
            l.prototype.normalize = function (a, g) {
                var d = a.touches,
                    k = d ? d.length ? d.item(0) :
                    m(d.changedTouches, a.changedTouches)[0] : a;
                g || (g = this.getChartPosition());
                d = k.pageX - g.left;
                g = k.pageY - g.top;
                if (k = this.chart.containerScaling) d /= k.scaleX, g /= k.scaleY;
                return q(a, {
                    chartX: Math.round(d),
                    chartY: Math.round(g)
                })
            };
            l.prototype.onContainerClick = function (a) {
                var g = this.chart,
                    d = g.hoverPoint;
                a = this.normalize(a);
                var k = g.plotLeft,
                    h = g.plotTop;
                g.cancelClick || (d && this.inClass(a.target, "highcharts-tracker") ? (E(d.series, "click", q(a, {
                    point: d
                })), g.hoverPoint && d.firePointEvent("click", a)) : (q(a, this.getCoordinates(a)),
                    g.isInsidePlot(a.chartX - k, a.chartY - h) && E(g, "click", a)))
            };
            l.prototype.onContainerMouseDown = function (k) {
                var g = 1 === ((k.buttons || k.button) & 1);
                k = this.normalize(k);
                if (a.isFirefox && 0 !== k.button) this.onContainerMouseMove(k);
                if ("undefined" === typeof k.button || g) this.zoomOption(k), g && k.preventDefault && k.preventDefault(), this.dragStart(k)
            };
            l.prototype.onContainerMouseLeave = function (k) {
                var g = G[m(a.hoverChartIndex, -1)],
                    d = this.chart.tooltip;
                k = this.normalize(k);
                g && (k.relatedTarget || k.toElement) && (g.pointer.reset(),
                    g.pointer.chartPosition = void 0);
                d && !d.isHidden && this.reset()
            };
            l.prototype.onContainerMouseEnter = function (a) {
                delete this.chartPosition
            };
            l.prototype.onContainerMouseMove = function (a) {
                var g = this.chart;
                a = this.normalize(a);
                this.setHoverChartIndex();
                a.preventDefault || (a.returnValue = !1);
                "mousedown" === g.mouseIsDown && this.drag(a);
                g.openMenu || !this.inClass(a.target, "highcharts-tracker") && !g.isInsidePlot(a.chartX - g.plotLeft, a.chartY - g.plotTop) || this.runPointActions(a)
            };
            l.prototype.onDocumentTouchEnd = function (k) {
                G[a.hoverChartIndex] &&
                    G[a.hoverChartIndex].pointer.drop(k)
            };
            l.prototype.onContainerTouchMove = function (a) {
                this.touch(a)
            };
            l.prototype.onContainerTouchStart = function (a) {
                this.zoomOption(a);
                this.touch(a, !0)
            };
            l.prototype.onDocumentMouseMove = function (a) {
                var g = this.chart,
                    d = this.chartPosition;
                a = this.normalize(a, d);
                var h = g.tooltip;
                !d || h && h.isStickyOnContact() || g.isInsidePlot(a.chartX - g.plotLeft, a.chartY - g.plotTop) || this.inClass(a.target, "highcharts-tracker") || this.reset()
            };
            l.prototype.onDocumentMouseUp = function (h) {
                var g = G[m(a.hoverChartIndex,
                    -1)];
                g && g.pointer.drop(h)
            };
            l.prototype.pinch = function (a) {
                var g = this,
                    d = g.chart,
                    h = g.pinchDown,
                    k = a.touches || [],
                    l = k.length,
                    f = g.lastValidTouch,
                    p = g.hasZoom,
                    t = g.selectionMarker,
                    u = {},
                    F = 1 === l && (g.inClass(a.target, "highcharts-tracker") && d.runTrackerClick || g.runChartClick),
                    e = {};
                1 < l && (g.initiated = !0);
                p && g.initiated && !F && a.preventDefault();
                [].map.call(k, function (c) {
                    return g.normalize(c)
                });
                "touchstart" === a.type ? ([].forEach.call(k, function (c, b) {
                        h[b] = {
                            chartX: c.chartX,
                            chartY: c.chartY
                        }
                    }), f.x = [h[0].chartX, h[1] && h[1].chartX],
                    f.y = [h[0].chartY, h[1] && h[1].chartY], d.axes.forEach(function (c) {
                        if (c.zoomEnabled) {
                            var b = d.bounds[c.horiz ? "h" : "v"],
                                e = c.minPixelPadding,
                                g = c.toPixels(Math.min(m(c.options.min, c.dataMin), c.dataMin)),
                                a = c.toPixels(Math.max(m(c.options.max, c.dataMax), c.dataMax)),
                                h = Math.max(g, a);
                            b.min = Math.min(c.pos, Math.min(g, a) - e);
                            b.max = Math.max(c.pos + c.len, h + e)
                        }
                    }), g.res = !0) : g.followTouchMove && 1 === l ? this.runPointActions(g.normalize(a)) : h.length && (t || (g.selectionMarker = t = q({
                    destroy: C,
                    touch: !0
                }, d.plotBox)), g.pinchTranslate(h,
                    k, u, t, e, f), g.hasPinched = p, g.scaleGroups(u, e), g.res && (g.res = !1, this.reset(!1, 0)))
            };
            l.prototype.pinchTranslate = function (a, g, d, h, l, f) {
                this.zoomHor && this.pinchTranslateDirection(!0, a, g, d, h, l, f);
                this.zoomVert && this.pinchTranslateDirection(!1, a, g, d, h, l, f)
            };
            l.prototype.pinchTranslateDirection = function (a, g, d, h, l, f, m, p) {
                var k = this.chart,
                    r = a ? "x" : "y",
                    x = a ? "X" : "Y",
                    e = "chart" + x,
                    c = a ? "width" : "height",
                    b = k["plot" + (a ? "Left" : "Top")],
                    B, w, t = p || 1,
                    A = k.inverted,
                    u = k.bounds[a ? "h" : "v"],
                    q = 1 === g.length,
                    v = g[0][e],
                    n = d[0][e],
                    I = !q &&
                    g[1][e],
                    N = !q && d[1][e];
                d = function () {
                    "number" === typeof N && 20 < Math.abs(v - I) && (t = p || Math.abs(n - N) / Math.abs(v - I));
                    w = (b - n) / t + v;
                    B = k["plot" + (a ? "Width" : "Height")] / t
                };
                d();
                g = w;
                if (g < u.min) {
                    g = u.min;
                    var H = !0
                } else g + B > u.max && (g = u.max - B, H = !0);
                H ? (n -= .8 * (n - m[r][0]), "number" === typeof N && (N -= .8 * (N - m[r][1])), d()) : m[r] = [n, N];
                A || (f[r] = w - b, f[c] = B);
                f = A ? 1 / t : t;
                l[c] = B;
                l[r] = g;
                h[A ? a ? "scaleY" : "scaleX" : "scale" + x] = t;
                h["translate" + x] = f * b + (n - f * v)
            };
            l.prototype.reset = function (a, g) {
                var d = this.chart,
                    k = d.hoverSeries,
                    l = d.hoverPoint,
                    f = d.hoverPoints,
                    m = d.tooltip,
                    p = m && m.shared ? f : l;
                a && p && h(p).forEach(function (d) {
                    d.series.isCartesian && "undefined" === typeof d.plotX && (a = !1)
                });
                if (a) m && p && h(p).length && (m.refresh(p), m.shared && f ? f.forEach(function (d) {
                    d.setState(d.state, !0);
                    d.series.isCartesian && (d.series.xAxis.crosshair && d.series.xAxis.drawCrosshair(null, d), d.series.yAxis.crosshair && d.series.yAxis.drawCrosshair(null, d))
                }) : l && (l.setState(l.state, !0), d.axes.forEach(function (d) {
                    d.crosshair && l.series[d.coll] === d && d.drawCrosshair(null, l)
                })));
                else {
                    if (l) l.onMouseOut();
                    f && f.forEach(function (d) {
                        d.setState()
                    });
                    if (k) k.onMouseOut();
                    m && m.hide(g);
                    this.unDocMouseMove && (this.unDocMouseMove = this.unDocMouseMove());
                    d.axes.forEach(function (d) {
                        d.hideCrosshair()
                    });
                    this.hoverX = d.hoverPoints = d.hoverPoint = null
                }
            };
            l.prototype.runPointActions = function (h, g) {
                var d = this.chart,
                    k = d.tooltip && d.tooltip.options.enabled ? d.tooltip : void 0,
                    l = k ? k.shared : !1,
                    f = g || d.hoverPoint,
                    p = f && f.series || d.hoverSeries;
                p = this.getHoverData(f, p, d.series, (!h || "touchmove" !== h.type) && (!!g || p && p.directTouch && this.isDirectTouch),
                    l, h);
                f = p.hoverPoint;
                var B = p.hoverPoints;
                g = (p = p.hoverSeries) && p.tooltipOptions.followPointer;
                l = l && p && !p.noSharedTooltip;
                if (f && (f !== d.hoverPoint || k && k.isHidden)) {
                    (d.hoverPoints || []).forEach(function (d) {
                        -1 === B.indexOf(d) && d.setState()
                    });
                    if (d.hoverSeries !== p) p.onMouseOver();
                    this.applyInactiveState(B);
                    (B || []).forEach(function (d) {
                        d.setState("hover")
                    });
                    d.hoverPoint && d.hoverPoint.firePointEvent("mouseOut");
                    if (!f.series) return;
                    d.hoverPoints = B;
                    d.hoverPoint = f;
                    f.firePointEvent("mouseOver");
                    k && k.refresh(l ? B : f,
                        h)
                } else g && k && !k.isHidden && (f = k.getAnchor([{}], h), k.updatePosition({
                    plotX: f[0],
                    plotY: f[1]
                }));
                this.unDocMouseMove || (this.unDocMouseMove = J(d.container.ownerDocument, "mousemove", function (d) {
                    var g = G[a.hoverChartIndex];
                    if (g) g.pointer.onDocumentMouseMove(d)
                }));
                d.axes.forEach(function (g) {
                    var a = m((g.crosshair || {}).snap, !0),
                        k;
                    a && ((k = d.hoverPoint) && k.series[g.coll] === g || (k = K(B, function (e) {
                        return e.series[g.coll] === g
                    })));
                    k || !a ? g.drawCrosshair(h, k) : g.hideCrosshair()
                })
            };
            l.prototype.scaleGroups = function (a, g) {
                var d =
                    this.chart,
                    h;
                d.series.forEach(function (k) {
                    h = a || k.getPlotBox();
                    k.xAxis && k.xAxis.zoomEnabled && k.group && (k.group.attr(h), k.markerGroup && (k.markerGroup.attr(h), k.markerGroup.clip(g ? d.clipRect : null)), k.dataLabelsGroup && k.dataLabelsGroup.attr(h))
                });
                d.clipRect.attr(g || d.clipBox)
            };
            l.prototype.setDOMEvents = function () {
                var h = this.chart.container,
                    g = h.ownerDocument;
                h.onmousedown = this.onContainerMouseDown.bind(this);
                h.onmousemove = this.onContainerMouseMove.bind(this);
                h.onclick = this.onContainerClick.bind(this);
                this.unbindContainerMouseEnter =
                    J(h, "mouseenter", this.onContainerMouseEnter.bind(this));
                this.unbindContainerMouseLeave = J(h, "mouseleave", this.onContainerMouseLeave.bind(this));
                a.unbindDocumentMouseUp || (a.unbindDocumentMouseUp = J(g, "mouseup", this.onDocumentMouseUp.bind(this)));
                a.hasTouch && (J(h, "touchstart", this.onContainerTouchStart.bind(this)), J(h, "touchmove", this.onContainerTouchMove.bind(this)), a.unbindDocumentTouchEnd || (a.unbindDocumentTouchEnd = J(g, "touchend", this.onDocumentTouchEnd.bind(this))))
            };
            l.prototype.setHoverChartIndex =
                function () {
                    var h = this.chart,
                        g = a.charts[m(a.hoverChartIndex, -1)];
                    if (g && g !== h) g.pointer.onContainerMouseLeave({
                        relatedTarget: !0
                    });
                    g && g.mouseIsDown || (a.hoverChartIndex = h.index)
                };
            l.prototype.touch = function (a, g) {
                var d = this.chart,
                    h;
                this.setHoverChartIndex();
                if (1 === a.touches.length)
                    if (a = this.normalize(a), (h = d.isInsidePlot(a.chartX - d.plotLeft, a.chartY - d.plotTop)) && !d.openMenu) {
                        g && this.runPointActions(a);
                        if ("touchmove" === a.type) {
                            g = this.pinchDown;
                            var k = g[0] ? 4 <= Math.sqrt(Math.pow(g[0].chartX - a.chartX, 2) + Math.pow(g[0].chartY -
                                a.chartY, 2)) : !1
                        }
                        m(k, !0) && this.pinch(a)
                    } else g && this.reset();
                else 2 === a.touches.length && this.pinch(a)
            };
            l.prototype.zoomOption = function (a) {
                var g = this.chart,
                    d = g.options.chart,
                    h = d.zoomType || "";
                g = g.inverted;
                /touch/.test(a.type) && (h = m(d.pinchType, h));
                this.zoomX = a = /x/.test(h);
                this.zoomY = h = /y/.test(h);
                this.zoomHor = a && !g || h && g;
                this.zoomVert = h && !g || a && g;
                this.hasZoom = a || h
            };
            return l
        }();
        return a.Pointer = f
    });
    O(n, "Core/MSPointer.js", [n["Core/Globals.js"], n["Core/Pointer.js"], n["Core/Utilities.js"]], function (f, a,
        n) {
        function y() {
            var a = [];
            a.item = function (a) {
                return this[a]
            };
            q(E, function (f) {
                a.push({
                    pageX: f.pageX,
                    pageY: f.pageY,
                    target: f.target
                })
            });
            return a
        }

        function D(a, p, u, m) {
            "touch" !== a.pointerType && a.pointerType !== a.MSPOINTER_TYPE_TOUCH || !C[f.hoverChartIndex] || (m(a), m = C[f.hoverChartIndex].pointer, m[p]({
                type: u,
                target: a.currentTarget,
                preventDefault: H,
                touches: y()
            }))
        }
        var G = this && this.__extends || function () {
                var a = function (f, p) {
                    a = Object.setPrototypeOf || {
                        __proto__: []
                    }
                    instanceof Array && function (a, h) {
                        a.__proto__ = h
                    } || function (a,
                        h) {
                        for (var l in h) h.hasOwnProperty(l) && (a[l] = h[l])
                    };
                    return a(f, p)
                };
                return function (f, p) {
                    function m() {
                        this.constructor = f
                    }
                    a(f, p);
                    f.prototype = null === p ? Object.create(p) : (m.prototype = p.prototype, new m)
                }
            }(),
            C = f.charts,
            J = f.doc,
            H = f.noop,
            v = n.addEvent,
            L = n.css,
            q = n.objectEach,
            K = n.removeEvent,
            E = {},
            p = !!f.win.PointerEvent;
        return function (a) {
            function f() {
                return null !== a && a.apply(this, arguments) || this
            }
            G(f, a);
            f.prototype.batchMSEvents = function (a) {
                a(this.chart.container, p ? "pointerdown" : "MSPointerDown", this.onContainerPointerDown);
                a(this.chart.container, p ? "pointermove" : "MSPointerMove", this.onContainerPointerMove);
                a(J, p ? "pointerup" : "MSPointerUp", this.onDocumentPointerUp)
            };
            f.prototype.destroy = function () {
                this.batchMSEvents(K);
                a.prototype.destroy.call(this)
            };
            f.prototype.init = function (f, m) {
                a.prototype.init.call(this, f, m);
                this.hasZoom && L(f.container, {
                    "-ms-touch-action": "none",
                    "touch-action": "none"
                })
            };
            f.prototype.onContainerPointerDown = function (a) {
                D(a, "onContainerTouchStart", "touchstart", function (a) {
                    E[a.pointerId] = {
                        pageX: a.pageX,
                        pageY: a.pageY,
                        target: a.currentTarget
                    }
                })
            };
            f.prototype.onContainerPointerMove = function (a) {
                D(a, "onContainerTouchMove", "touchmove", function (a) {
                    E[a.pointerId] = {
                        pageX: a.pageX,
                        pageY: a.pageY
                    };
                    E[a.pointerId].target || (E[a.pointerId].target = a.currentTarget)
                })
            };
            f.prototype.onDocumentPointerUp = function (a) {
                D(a, "onDocumentTouchEnd", "touchend", function (a) {
                    delete E[a.pointerId]
                })
            };
            f.prototype.setDOMEvents = function () {
                a.prototype.setDOMEvents.call(this);
                (this.hasZoom || this.followTouchMove) && this.batchMSEvents(v)
            };
            return f
        }(a)
    });
    O(n, "Core/Legend.js", [n["Core/Globals.js"], n["Core/Utilities.js"]], function (f, a) {
        var n = a.addEvent,
            y = a.animObject,
            D = a.css,
            G = a.defined,
            C = a.discardElement,
            J = a.find,
            H = a.fireEvent,
            v = a.format,
            L = a.isNumber,
            q = a.merge,
            K = a.pick,
            E = a.relativeLength,
            p = a.setAnimation,
            t = a.stableSort,
            I = a.syncTimeout;
        a = a.wrap;
        var u = f.isFirefox,
            m = f.marginNames,
            h = f.win,
            l = function () {
                function a(a, d) {
                    this.allItems = [];
                    this.contentGroup = this.box = void 0;
                    this.display = !1;
                    this.group = void 0;
                    this.offsetWidth = this.maxLegendWidth = this.maxItemWidth =
                        this.legendWidth = this.legendHeight = this.lastLineHeight = this.lastItemY = this.itemY = this.itemX = this.itemMarginTop = this.itemMarginBottom = this.itemHeight = this.initialItemY = 0;
                    this.options = {};
                    this.padding = 0;
                    this.pages = [];
                    this.proximate = !1;
                    this.scrollGroup = void 0;
                    this.widthOption = this.totalItemWidth = this.titleHeight = this.symbolWidth = this.symbolHeight = 0;
                    this.chart = a;
                    this.init(a, d)
                }
                a.prototype.init = function (a, d) {
                    this.chart = a;
                    this.setOptions(d);
                    d.enabled && (this.render(), n(this.chart, "endResize", function () {
                            this.legend.positionCheckboxes()
                        }),
                        this.proximate ? this.unchartrender = n(this.chart, "render", function () {
                            this.legend.proximatePositions();
                            this.legend.positionItems()
                        }) : this.unchartrender && this.unchartrender())
                };
                a.prototype.setOptions = function (a) {
                    var d = K(a.padding, 8);
                    this.options = a;
                    this.chart.styledMode || (this.itemStyle = a.itemStyle, this.itemHiddenStyle = q(this.itemStyle, a.itemHiddenStyle));
                    this.itemMarginTop = a.itemMarginTop || 0;
                    this.itemMarginBottom = a.itemMarginBottom || 0;
                    this.padding = d;
                    this.initialItemY = d - 5;
                    this.symbolWidth = K(a.symbolWidth,
                        16);
                    this.pages = [];
                    this.proximate = "proximate" === a.layout && !this.chart.inverted;
                    this.baseline = void 0
                };
                a.prototype.update = function (a, d) {
                    var g = this.chart;
                    this.setOptions(q(!0, this.options, a));
                    this.destroy();
                    g.isDirtyLegend = g.isDirtyBox = !0;
                    K(d, !0) && g.redraw();
                    H(this, "afterUpdate")
                };
                a.prototype.colorizeItem = function (a, d) {
                    a.legendGroup[d ? "removeClass" : "addClass"]("highcharts-legend-item-hidden");
                    if (!this.chart.styledMode) {
                        var g = this.options,
                            h = a.legendItem,
                            k = a.legendLine,
                            f = a.legendSymbol,
                            l = this.itemHiddenStyle.color;
                        g = d ? g.itemStyle.color : l;
                        var m = d ? a.color || l : l,
                            p = a.options && a.options.marker,
                            t = {
                                fill: m
                            };
                        h && h.css({
                            fill: g,
                            color: g
                        });
                        k && k.attr({
                            stroke: m
                        });
                        f && (p && f.isMarker && (t = a.pointAttribs(), d || (t.stroke = t.fill = l)), f.attr(t))
                    }
                    H(this, "afterColorizeItem", {
                        item: a,
                        visible: d
                    })
                };
                a.prototype.positionItems = function () {
                    this.allItems.forEach(this.positionItem, this);
                    this.chart.isResizing || this.positionCheckboxes()
                };
                a.prototype.positionItem = function (a) {
                    var d = this,
                        g = this.options,
                        h = g.symbolPadding,
                        k = !g.rtl,
                        f = a._legendItemPos;
                    g =
                        f[0];
                    f = f[1];
                    var l = a.checkbox,
                        m = a.legendGroup;
                    m && m.element && (h = {
                        translateX: k ? g : this.legendWidth - g - 2 * h - 4,
                        translateY: f
                    }, k = function () {
                        H(d, "afterPositionItem", {
                            item: a
                        })
                    }, G(m.translateY) ? m.animate(h, void 0, k) : (m.attr(h), k()));
                    l && (l.x = g, l.y = f)
                };
                a.prototype.destroyItem = function (a) {
                    var d = a.checkbox;
                    ["legendItem", "legendLine", "legendSymbol", "legendGroup"].forEach(function (d) {
                        a[d] && (a[d] = a[d].destroy())
                    });
                    d && C(a.checkbox)
                };
                a.prototype.destroy = function () {
                    function a(d) {
                        this[d] && (this[d] = this[d].destroy())
                    }
                    this.getAllItems().forEach(function (d) {
                        ["legendItem",
                            "legendGroup"
                        ].forEach(a, d)
                    });
                    "clipRect up down pager nav box title group".split(" ").forEach(a, this);
                    this.display = null
                };
                a.prototype.positionCheckboxes = function () {
                    var a = this.group && this.group.alignAttr,
                        d = this.clipHeight || this.legendHeight,
                        h = this.titleHeight;
                    if (a) {
                        var k = a.translateY;
                        this.allItems.forEach(function (g) {
                            var f = g.checkbox;
                            if (f) {
                                var l = k + h + f.y + (this.scrollOffset || 0) + 3;
                                D(f, {
                                    left: a.translateX + g.checkboxOffset + f.x - 20 + "px",
                                    top: l + "px",
                                    display: this.proximate || l > k - 6 && l < k + d - 6 ? "" : "none"
                                })
                            }
                        }, this)
                    }
                };
                a.prototype.renderTitle = function () {
                    var a = this.options,
                        d = this.padding,
                        h = a.title,
                        k = 0;
                    h.text && (this.title || (this.title = this.chart.renderer.label(h.text, d - 3, d - 4, null, null, null, a.useHTML, null, "legend-title").attr({
                        zIndex: 1
                    }), this.chart.styledMode || this.title.css(h.style), this.title.add(this.group)), h.width || this.title.css({
                        width: this.maxLegendWidth + "px"
                    }), a = this.title.getBBox(), k = a.height, this.offsetWidth = a.width, this.contentGroup.attr({
                        translateY: k
                    }));
                    this.titleHeight = k
                };
                a.prototype.setText = function (a) {
                    var d =
                        this.options;
                    a.legendItem.attr({
                        text: d.labelFormat ? v(d.labelFormat, a, this.chart) : d.labelFormatter.call(a)
                    })
                };
                a.prototype.renderItem = function (a) {
                    var d = this.chart,
                        g = d.renderer,
                        h = this.options,
                        k = this.symbolWidth,
                        f = h.symbolPadding,
                        l = this.itemStyle,
                        m = this.itemHiddenStyle,
                        p = "horizontal" === h.layout ? K(h.itemDistance, 20) : 0,
                        t = !h.rtl,
                        e = a.legendItem,
                        c = !a.series,
                        b = !c && a.series.drawLegendSymbol ? a.series : a,
                        z = b.options;
                    z = this.createCheckboxForItem && z && z.showCheckbox;
                    p = k + f + p + (z ? 20 : 0);
                    var w = h.useHTML,
                        u = a.options.className;
                    e || (a.legendGroup = g.g("legend-item").addClass("highcharts-" + b.type + "-series highcharts-color-" + a.colorIndex + (u ? " " + u : "") + (c ? " highcharts-series-" + a.index : "")).attr({
                            zIndex: 1
                        }).add(this.scrollGroup), a.legendItem = e = g.text("", t ? k + f : -f, this.baseline || 0, w), d.styledMode || e.css(q(a.visible ? l : m)), e.attr({
                            align: t ? "left" : "right",
                            zIndex: 2
                        }).add(a.legendGroup), this.baseline || (this.fontMetrics = g.fontMetrics(d.styledMode ? 12 : l.fontSize, e), this.baseline = this.fontMetrics.f + 3 + this.itemMarginTop, e.attr("y", this.baseline)),
                        this.symbolHeight = h.symbolHeight || this.fontMetrics.f, b.drawLegendSymbol(this, a), this.setItemEvents && this.setItemEvents(a, e, w));
                    z && !a.checkbox && this.createCheckboxForItem && this.createCheckboxForItem(a);
                    this.colorizeItem(a, a.visible);
                    !d.styledMode && l.width || e.css({
                        width: (h.itemWidth || this.widthOption || d.spacingBox.width) - p + "px"
                    });
                    this.setText(a);
                    d = e.getBBox();
                    a.itemWidth = a.checkboxOffset = h.itemWidth || a.legendItemWidth || d.width + p;
                    this.maxItemWidth = Math.max(this.maxItemWidth, a.itemWidth);
                    this.totalItemWidth +=
                        a.itemWidth;
                    this.itemHeight = a.itemHeight = Math.round(a.legendItemHeight || d.height || this.symbolHeight)
                };
                a.prototype.layoutItem = function (a) {
                    var d = this.options,
                        g = this.padding,
                        h = "horizontal" === d.layout,
                        k = a.itemHeight,
                        f = this.itemMarginBottom,
                        l = this.itemMarginTop,
                        m = h ? K(d.itemDistance, 20) : 0,
                        p = this.maxLegendWidth;
                    d = d.alignColumns && this.totalItemWidth > p ? this.maxItemWidth : a.itemWidth;
                    h && this.itemX - g + d > p && (this.itemX = g, this.lastLineHeight && (this.itemY += l + this.lastLineHeight + f), this.lastLineHeight = 0);
                    this.lastItemY =
                        l + this.itemY + f;
                    this.lastLineHeight = Math.max(k, this.lastLineHeight);
                    a._legendItemPos = [this.itemX, this.itemY];
                    h ? this.itemX += d : (this.itemY += l + k + f, this.lastLineHeight = k);
                    this.offsetWidth = this.widthOption || Math.max((h ? this.itemX - g - (a.checkbox ? 0 : m) : d) + g, this.offsetWidth)
                };
                a.prototype.getAllItems = function () {
                    var a = [];
                    this.chart.series.forEach(function (d) {
                        var g = d && d.options;
                        d && K(g.showInLegend, G(g.linkedTo) ? !1 : void 0, !0) && (a = a.concat(d.legendItems || ("point" === g.legendType ? d.data : d)))
                    });
                    H(this, "afterGetAllItems", {
                        allItems: a
                    });
                    return a
                };
                a.prototype.getAlignment = function () {
                    var a = this.options;
                    return this.proximate ? a.align.charAt(0) + "tv" : a.floating ? "" : a.align.charAt(0) + a.verticalAlign.charAt(0) + a.layout.charAt(0)
                };
                a.prototype.adjustMargins = function (a, d) {
                    var g = this.chart,
                        h = this.options,
                        k = this.getAlignment();
                    k && [/(lth|ct|rth)/, /(rtv|rm|rbv)/, /(rbh|cb|lbh)/, /(lbv|lm|ltv)/].forEach(function (f, l) {
                        f.test(k) && !G(a[l]) && (g[m[l]] = Math.max(g[m[l]], g.legend[(l + 1) % 2 ? "legendHeight" : "legendWidth"] + [1, -1, -1, 1][l] * h[l % 2 ? "x" :
                            "y"] + K(h.margin, 12) + d[l] + (g.titleOffset[l] || 0)))
                    })
                };
                a.prototype.proximatePositions = function () {
                    var a = this.chart,
                        d = [],
                        h = "left" === this.options.align;
                    this.allItems.forEach(function (g) {
                        var k;
                        var l = h;
                        if (g.yAxis) {
                            g.xAxis.options.reversed && (l = !l);
                            g.points && (k = J(l ? g.points : g.points.slice(0).reverse(), function (d) {
                                return L(d.plotY)
                            }));
                            l = this.itemMarginTop + g.legendItem.getBBox().height + this.itemMarginBottom;
                            var f = g.yAxis.top - a.plotTop;
                            g.visible ? (k = k ? k.plotY : g.yAxis.height, k += f - .3 * l) : k = f + g.yAxis.height;
                            d.push({
                                target: k,
                                size: l,
                                item: g
                            })
                        }
                    }, this);
                    f.distribute(d, a.plotHeight);
                    d.forEach(function (d) {
                        d.item._legendItemPos[1] = a.plotTop - a.spacing[0] + d.pos
                    })
                };
                a.prototype.render = function () {
                    var a = this.chart,
                        d = a.renderer,
                        h = this.group,
                        k = this.box,
                        l = this.options,
                        f = this.padding;
                    this.itemX = f;
                    this.itemY = this.initialItemY;
                    this.lastItemY = this.offsetWidth = 0;
                    this.widthOption = E(l.width, a.spacingBox.width - f);
                    var m = a.spacingBox.width - 2 * f - l.x; - 1 < ["rm", "lm"].indexOf(this.getAlignment().substring(0, 2)) && (m /= 2);
                    this.maxLegendWidth = this.widthOption ||
                        m;
                    h || (this.group = h = d.g("legend").attr({
                        zIndex: 7
                    }).add(), this.contentGroup = d.g().attr({
                        zIndex: 1
                    }).add(h), this.scrollGroup = d.g().add(this.contentGroup));
                    this.renderTitle();
                    var p = this.getAllItems();
                    t(p, function (d, e) {
                        return (d.options && d.options.legendIndex || 0) - (e.options && e.options.legendIndex || 0)
                    });
                    l.reversed && p.reverse();
                    this.allItems = p;
                    this.display = m = !!p.length;
                    this.itemHeight = this.totalItemWidth = this.maxItemWidth = this.lastLineHeight = 0;
                    p.forEach(this.renderItem, this);
                    p.forEach(this.layoutItem, this);
                    p = (this.widthOption || this.offsetWidth) + f;
                    var q = this.lastItemY + this.lastLineHeight + this.titleHeight;
                    q = this.handleOverflow(q);
                    q += f;
                    k || (this.box = k = d.rect().addClass("highcharts-legend-box").attr({
                        r: l.borderRadius
                    }).add(h), k.isNew = !0);
                    a.styledMode || k.attr({
                        stroke: l.borderColor,
                        "stroke-width": l.borderWidth || 0,
                        fill: l.backgroundColor || "none"
                    }).shadow(l.shadow);
                    0 < p && 0 < q && (k[k.isNew ? "attr" : "animate"](k.crisp.call({}, {
                        x: 0,
                        y: 0,
                        width: p,
                        height: q
                    }, k.strokeWidth())), k.isNew = !1);
                    k[m ? "show" : "hide"]();
                    a.styledMode &&
                        "none" === h.getStyle("display") && (p = q = 0);
                    this.legendWidth = p;
                    this.legendHeight = q;
                    m && this.align();
                    this.proximate || this.positionItems();
                    H(this, "afterRender")
                };
                a.prototype.align = function (a) {
                    void 0 === a && (a = this.chart.spacingBox);
                    var d = this.chart,
                        g = this.options,
                        h = a.y;
                    /(lth|ct|rth)/.test(this.getAlignment()) && 0 < d.titleOffset[0] ? h += d.titleOffset[0] : /(lbh|cb|rbh)/.test(this.getAlignment()) && 0 < d.titleOffset[2] && (h -= d.titleOffset[2]);
                    h !== a.y && (a = q(a, {
                        y: h
                    }));
                    this.group.align(q(g, {
                        width: this.legendWidth,
                        height: this.legendHeight,
                        verticalAlign: this.proximate ? "top" : g.verticalAlign
                    }), !0, a)
                };
                a.prototype.handleOverflow = function (a) {
                    var d = this,
                        g = this.chart,
                        h = g.renderer,
                        k = this.options,
                        l = k.y,
                        f = this.padding;
                    l = g.spacingBox.height + ("top" === k.verticalAlign ? -l : l) - f;
                    var m = k.maxHeight,
                        p, t = this.clipRect,
                        e = k.navigation,
                        c = K(e.animation, !0),
                        b = e.arrowSize || 12,
                        z = this.nav,
                        w = this.pages,
                        q, u = this.allItems,
                        n = function (b) {
                            "number" === typeof b ? t.attr({
                                height: b
                            }) : t && (d.clipRect = t.destroy(), d.contentGroup.clip());
                            d.contentGroup.div && (d.contentGroup.div.style.clip =
                                b ? "rect(" + f + "px,9999px," + (f + b) + "px,0)" : "auto")
                        },
                        v = function (c) {
                            d[c] = h.circle(0, 0, 1.3 * b).translate(b / 2, b / 2).add(z);
                            g.styledMode || d[c].attr("fill", "rgba(0,0,0,0.0001)");
                            return d[c]
                        };
                    "horizontal" !== k.layout || "middle" === k.verticalAlign || k.floating || (l /= 2);
                    m && (l = Math.min(l, m));
                    w.length = 0;
                    a > l && !1 !== e.enabled ? (this.clipHeight = p = Math.max(l - 20 - this.titleHeight - f, 0), this.currentPage = K(this.currentPage, 1), this.fullHeight = a, u.forEach(function (b, c) {
                        var e = b._legendItemPos[1],
                            d = Math.round(b.legendItem.getBBox().height),
                            a = w.length;
                        if (!a || e - w[a - 1] > p && (q || e) !== w[a - 1]) w.push(q || e), a++;
                        b.pageIx = a - 1;
                        q && (u[c - 1].pageIx = a - 1);
                        c === u.length - 1 && e + d - w[a - 1] > p && e !== q && (w.push(e), b.pageIx = a);
                        e !== q && (q = e)
                    }), t || (t = d.clipRect = h.clipRect(0, f, 9999, 0), d.contentGroup.clip(t)), n(p), z || (this.nav = z = h.g().attr({
                            zIndex: 1
                        }).add(this.group), this.up = h.symbol("triangle", 0, 0, b, b).add(z), v("upTracker").on("click", function () {
                            d.scroll(-1, c)
                        }), this.pager = h.text("", 15, 10).addClass("highcharts-legend-navigation"), g.styledMode || this.pager.css(e.style),
                        this.pager.add(z), this.down = h.symbol("triangle-down", 0, 0, b, b).add(z), v("downTracker").on("click", function () {
                            d.scroll(1, c)
                        })), d.scroll(0), a = l) : z && (n(), this.nav = z.destroy(), this.scrollGroup.attr({
                        translateY: 1
                    }), this.clipHeight = 0);
                    return a
                };
                a.prototype.scroll = function (a, d) {
                    var g = this,
                        h = this.chart,
                        k = this.pages,
                        l = k.length,
                        f = this.currentPage + a;
                    a = this.clipHeight;
                    var m = this.options.navigation,
                        t = this.pager,
                        q = this.padding;
                    f > l && (f = l);
                    0 < f && ("undefined" !== typeof d && p(d, h), this.nav.attr({
                        translateX: q,
                        translateY: a +
                            this.padding + 7 + this.titleHeight,
                        visibility: "visible"
                    }), [this.up, this.upTracker].forEach(function (e) {
                        e.attr({
                            "class": 1 === f ? "highcharts-legend-nav-inactive" : "highcharts-legend-nav-active"
                        })
                    }), t.attr({
                        text: f + "/" + l
                    }), [this.down, this.downTracker].forEach(function (e) {
                        e.attr({
                            x: 18 + this.pager.getBBox().width,
                            "class": f === l ? "highcharts-legend-nav-inactive" : "highcharts-legend-nav-active"
                        })
                    }, this), h.styledMode || (this.up.attr({
                        fill: 1 === f ? m.inactiveColor : m.activeColor
                    }), this.upTracker.css({
                        cursor: 1 === f ? "default" : "pointer"
                    }), this.down.attr({
                        fill: f === l ? m.inactiveColor : m.activeColor
                    }), this.downTracker.css({
                        cursor: f === l ? "default" : "pointer"
                    })), this.scrollOffset = -k[f - 1] + this.initialItemY, this.scrollGroup.animate({
                        translateY: this.scrollOffset
                    }), this.currentPage = f, this.positionCheckboxes(), d = y(K(d, h.renderer.globalAnimation, !0)), I(function () {
                        H(g, "afterScroll", {
                            currentPage: f
                        })
                    }, d.duration))
                };
                return a
            }();
        (/Trident\/7\.0/.test(h.navigator && h.navigator.userAgent) || u) && a(l.prototype, "positionItem", function (a, g) {
            var d =
                this,
                h = function () {
                    g._legendItemPos && a.call(d, g)
                };
            h();
            d.bubbleLegend || setTimeout(h)
        });
        f.Legend = l;
        return f.Legend
    });
    O(n, "Core/Chart/Chart.js", [n["Core/Axis/Axis.js"], n["Core/Globals.js"], n["Core/Legend.js"], n["Core/MSPointer.js"], n["Core/Options.js"], n["Core/Pointer.js"], n["Core/Time.js"], n["Core/Utilities.js"]], function (f, a, n, y, D, G, C, J) {
        var H = a.charts,
            v = a.doc,
            L = a.seriesTypes,
            q = a.win,
            K = D.defaultOptions,
            E = J.addEvent,
            p = J.animate,
            t = J.animObject,
            I = J.attr,
            u = J.createElement,
            m = J.css,
            h = J.defined,
            l = J.discardElement,
            k = J.erase,
            g = J.error,
            d = J.extend,
            x = J.find,
            r = J.fireEvent,
            A = J.getStyle,
            N = J.isArray,
            B = J.isFunction,
            M = J.isNumber,
            R = J.isObject,
            F = J.isString,
            e = J.merge,
            c = J.numberFormat,
            b = J.objectEach,
            z = J.pick,
            w = J.pInt,
            P = J.relativeLength,
            Z = J.removeEvent,
            W = J.setAnimation,
            aa = J.splat,
            X = J.syncTimeout,
            ba = J.uniqueKey,
            ca = a.marginNames,
            Y = function () {
                function D(b, c, e) {
                    this.yAxis = this.xAxis = this.userOptions = this.titleOffset = this.time = this.symbolCounter = this.spacingBox = this.spacing = this.series = this.renderTo = this.renderer = this.pointer =
                        this.pointCount = this.plotWidth = this.plotTop = this.plotLeft = this.plotHeight = this.plotBox = this.options = this.numberFormatter = this.margin = this.legend = this.labelCollectors = this.isResizing = this.index = this.container = this.colorCounter = this.clipBox = this.chartWidth = this.chartHeight = this.bounds = this.axisOffset = this.axes = void 0;
                    this.getArgs(b, c, e)
                }
                D.prototype.getArgs = function (b, c, e) {
                    F(b) || b.nodeName ? (this.renderTo = b, this.init(c, e)) : this.init(b, c)
                };
                D.prototype.init = function (d, g) {
                    var h, k = d.series,
                        l = d.plotOptions || {};
                    r(this, "init", {
                        args: arguments
                    }, function () {
                        d.series = null;
                        h = e(K, d);
                        var f = h.chart || {};
                        b(h.plotOptions, function (b, c) {
                            R(b) && (b.tooltip = l[c] && e(l[c].tooltip) || void 0)
                        });
                        h.tooltip.userOptions = d.chart && d.chart.forExport && d.tooltip.userOptions || d.tooltip;
                        h.series = d.series = k;
                        this.userOptions = d;
                        var m = f.events;
                        this.margin = [];
                        this.spacing = [];
                        this.bounds = {
                            h: {},
                            v: {}
                        };
                        this.labelCollectors = [];
                        this.callback = g;
                        this.isResizing = 0;
                        this.options = h;
                        this.axes = [];
                        this.series = [];
                        this.time = d.time && Object.keys(d.time).length ?
                            new C(d.time) : a.time;
                        this.numberFormatter = f.numberFormatter || c;
                        this.styledMode = f.styledMode;
                        this.hasCartesianSeries = f.showAxes;
                        var p = this;
                        p.index = H.length;
                        H.push(p);
                        a.chartCount++;
                        m && b(m, function (b, c) {
                            B(b) && E(p, c, b)
                        });
                        p.xAxis = [];
                        p.yAxis = [];
                        p.pointCount = p.colorCounter = p.symbolCounter = 0;
                        r(p, "afterInit");
                        p.firstRender()
                    })
                };
                D.prototype.initSeries = function (b) {
                    var c = this.options.chart;
                    c = b.type || c.type || c.defaultSeriesType;
                    var e = L[c];
                    e || g(17, !0, this, {
                        missingModuleFor: c
                    });
                    c = new e;
                    c.init(this, b);
                    return c
                };
                D.prototype.setSeriesData = function () {
                    this.getSeriesOrderByLinks().forEach(function (b) {
                        b.points || b.data || !b.enabledDataSorting || b.setData(b.options.data, !1)
                    })
                };
                D.prototype.getSeriesOrderByLinks = function () {
                    return this.series.concat().sort(function (b, c) {
                        return b.linkedSeries.length || c.linkedSeries.length ? c.linkedSeries.length - b.linkedSeries.length : 0
                    })
                };
                D.prototype.orderSeries = function (b) {
                    var c = this.series;
                    for (b = b || 0; b < c.length; b++) c[b] && (c[b].index = b, c[b].name = c[b].getName())
                };
                D.prototype.isInsidePlot =
                    function (b, c, e) {
                        var d = e ? c : b;
                        b = e ? b : c;
                        d = {
                            x: d,
                            y: b,
                            isInsidePlot: 0 <= d && d <= this.plotWidth && 0 <= b && b <= this.plotHeight
                        };
                        r(this, "afterIsInsidePlot", d);
                        return d.isInsidePlot
                    };
                D.prototype.redraw = function (b) {
                    r(this, "beforeRedraw");
                    var c = this,
                        e = c.axes,
                        a = c.series,
                        g = c.pointer,
                        h = c.legend,
                        k = c.userOptions.legend,
                        l = c.isDirtyLegend,
                        f = c.hasCartesianSeries,
                        m = c.isDirtyBox,
                        p = c.renderer,
                        w = p.isHidden(),
                        z = [];
                    c.setResponsive && c.setResponsive(!1);
                    W(c.hasRendered ? b : !1, c);
                    w && c.temporaryDisplay();
                    c.layOutTitles();
                    for (b = a.length; b--;) {
                        var t =
                            a[b];
                        if (t.options.stacking) {
                            var B = !0;
                            if (t.isDirty) {
                                var q = !0;
                                break
                            }
                        }
                    }
                    if (q)
                        for (b = a.length; b--;) t = a[b], t.options.stacking && (t.isDirty = !0);
                    a.forEach(function (b) {
                        b.isDirty && ("point" === b.options.legendType ? (b.updateTotals && b.updateTotals(), l = !0) : k && (k.labelFormatter || k.labelFormat) && (l = !0));
                        b.isDirtyData && r(b, "updatedData")
                    });
                    l && h && h.options.enabled && (h.render(), c.isDirtyLegend = !1);
                    B && c.getStacks();
                    f && e.forEach(function (b) {
                        c.isResizing && M(b.min) || (b.updateNames(), b.setScale())
                    });
                    c.getMargins();
                    f && (e.forEach(function (b) {
                        b.isDirty &&
                            (m = !0)
                    }), e.forEach(function (b) {
                        var c = b.min + "," + b.max;
                        b.extKey !== c && (b.extKey = c, z.push(function () {
                            r(b, "afterSetExtremes", d(b.eventArgs, b.getExtremes()));
                            delete b.eventArgs
                        }));
                        (m || B) && b.redraw()
                    }));
                    m && c.drawChartBox();
                    r(c, "predraw");
                    a.forEach(function (b) {
                        (m || b.isDirty) && b.visible && b.redraw();
                        b.isDirtyData = !1
                    });
                    g && g.reset(!0);
                    p.draw();
                    r(c, "redraw");
                    r(c, "render");
                    w && c.temporaryDisplay(!0);
                    z.forEach(function (b) {
                        b.call()
                    })
                };
                D.prototype.get = function (b) {
                    function c(c) {
                        return c.id === b || c.options && c.options.id ===
                            b
                    }
                    var e = this.series,
                        d;
                    var a = x(this.axes, c) || x(this.series, c);
                    for (d = 0; !a && d < e.length; d++) a = x(e[d].points || [], c);
                    return a
                };
                D.prototype.getAxes = function () {
                    var b = this,
                        c = this.options,
                        e = c.xAxis = aa(c.xAxis || {});
                    c = c.yAxis = aa(c.yAxis || {});
                    r(this, "getAxes");
                    e.forEach(function (b, c) {
                        b.index = c;
                        b.isX = !0
                    });
                    c.forEach(function (b, c) {
                        b.index = c
                    });
                    e.concat(c).forEach(function (c) {
                        new f(b, c)
                    });
                    r(this, "afterGetAxes")
                };
                D.prototype.getSelectedPoints = function () {
                    var b = [];
                    this.series.forEach(function (c) {
                        b = b.concat(c.getPointsCollection().filter(function (b) {
                            return z(b.selectedStaging,
                                b.selected)
                        }))
                    });
                    return b
                };
                D.prototype.getSelectedSeries = function () {
                    return this.series.filter(function (b) {
                        return b.selected
                    })
                };
                D.prototype.setTitle = function (b, c, e) {
                    this.applyDescription("title", b);
                    this.applyDescription("subtitle", c);
                    this.applyDescription("caption", void 0);
                    this.layOutTitles(e)
                };
                D.prototype.applyDescription = function (b, c) {
                    var d = this,
                        a = "title" === b ? {
                            color: "#333333",
                            fontSize: this.options.isStock ? "16px" : "18px"
                        } : {
                            color: "#666666"
                        };
                    a = this.options[b] = e(!this.styledMode && {
                            style: a
                        }, this.options[b],
                        c);
                    var g = this[b];
                    g && c && (this[b] = g = g.destroy());
                    a && !g && (g = this.renderer.text(a.text, 0, 0, a.useHTML).attr({
                        align: a.align,
                        "class": "highcharts-" + b,
                        zIndex: a.zIndex || 4
                    }).add(), g.update = function (c) {
                        d[{
                            title: "setTitle",
                            subtitle: "setSubtitle",
                            caption: "setCaption"
                        } [b]](c)
                    }, this.styledMode || g.css(a.style), this[b] = g)
                };
                D.prototype.layOutTitles = function (b) {
                    var c = [0, 0, 0],
                        e = this.renderer,
                        a = this.spacingBox;
                    ["title", "subtitle", "caption"].forEach(function (b) {
                        var g = this[b],
                            h = this.options[b],
                            k = h.verticalAlign || "top";
                        b =
                            "title" === b ? -3 : "top" === k ? c[0] + 2 : 0;
                        if (g) {
                            if (!this.styledMode) var l = h.style.fontSize;
                            l = e.fontMetrics(l, g).b;
                            g.css({
                                width: (h.width || a.width + (h.widthAdjust || 0)) + "px"
                            });
                            var f = Math.round(g.getBBox(h.useHTML).height);
                            g.align(d({
                                y: "bottom" === k ? l : b + l,
                                height: f
                            }, h), !1, "spacingBox");
                            h.floating || ("top" === k ? c[0] = Math.ceil(c[0] + f) : "bottom" === k && (c[2] = Math.ceil(c[2] + f)))
                        }
                    }, this);
                    c[0] && "top" === (this.options.title.verticalAlign || "top") && (c[0] += this.options.title.margin);
                    c[2] && "bottom" === this.options.caption.verticalAlign &&
                        (c[2] += this.options.caption.margin);
                    var g = !this.titleOffset || this.titleOffset.join(",") !== c.join(",");
                    this.titleOffset = c;
                    r(this, "afterLayOutTitles");
                    !this.isDirtyBox && g && (this.isDirtyBox = this.isDirtyLegend = g, this.hasRendered && z(b, !0) && this.isDirtyBox && this.redraw())
                };
                D.prototype.getChartSize = function () {
                    var b = this.options.chart,
                        c = b.width;
                    b = b.height;
                    var e = this.renderTo;
                    h(c) || (this.containerWidth = A(e, "width"));
                    h(b) || (this.containerHeight = A(e, "height"));
                    this.chartWidth = Math.max(0, c || this.containerWidth ||
                        600);
                    this.chartHeight = Math.max(0, P(b, this.chartWidth) || (1 < this.containerHeight ? this.containerHeight : 400))
                };
                D.prototype.temporaryDisplay = function (b) {
                    var c = this.renderTo;
                    if (b)
                        for (; c && c.style;) c.hcOrigStyle && (m(c, c.hcOrigStyle), delete c.hcOrigStyle), c.hcOrigDetached && (v.body.removeChild(c), c.hcOrigDetached = !1), c = c.parentNode;
                    else
                        for (; c && c.style;) {
                            v.body.contains(c) || c.parentNode || (c.hcOrigDetached = !0, v.body.appendChild(c));
                            if ("none" === A(c, "display", !1) || c.hcOricDetached) c.hcOrigStyle = {
                                display: c.style.display,
                                height: c.style.height,
                                overflow: c.style.overflow
                            }, b = {
                                display: "block",
                                overflow: "hidden"
                            }, c !== this.renderTo && (b.height = 0), m(c, b), c.offsetWidth || c.style.setProperty("display", "block", "important");
                            c = c.parentNode;
                            if (c === v.body) break
                        }
                };
                D.prototype.setClassName = function (b) {
                    this.container.className = "highcharts-container " + (b || "")
                };
                D.prototype.getContainer = function () {
                    var b = this.options,
                        c = b.chart;
                    var e = this.renderTo;
                    var h = ba(),
                        k, l;
                    e || (this.renderTo = e = c.renderTo);
                    F(e) && (this.renderTo = e = v.getElementById(e));
                    e ||
                        g(13, !0, this);
                    var f = w(I(e, "data-highcharts-chart"));
                    M(f) && H[f] && H[f].hasRendered && H[f].destroy();
                    I(e, "data-highcharts-chart", this.index);
                    e.innerHTML = "";
                    c.skipClone || e.offsetWidth || this.temporaryDisplay();
                    this.getChartSize();
                    f = this.chartWidth;
                    var p = this.chartHeight;
                    m(e, {
                        overflow: "hidden"
                    });
                    this.styledMode || (k = d({
                        position: "relative",
                        overflow: "hidden",
                        width: f + "px",
                        height: p + "px",
                        textAlign: "left",
                        lineHeight: "normal",
                        zIndex: 0,
                        "-webkit-tap-highlight-color": "rgba(0,0,0,0)",
                        userSelect: "none"
                    }, c.style));
                    this.container =
                        e = u("div", {
                            id: h
                        }, k, e);
                    this._cursor = e.style.cursor;
                    this.renderer = new(a[c.renderer] || a.Renderer)(e, f, p, null, c.forExport, b.exporting && b.exporting.allowHTML, this.styledMode);
                    W(void 0, this);
                    this.setClassName(c.className);
                    if (this.styledMode)
                        for (l in b.defs) this.renderer.definition(b.defs[l]);
                    else this.renderer.setStyle(c.style);
                    this.renderer.chartIndex = this.index;
                    r(this, "afterGetContainer")
                };
                D.prototype.getMargins = function (b) {
                    var c = this.spacing,
                        e = this.margin,
                        d = this.titleOffset;
                    this.resetMargins();
                    d[0] &&
                        !h(e[0]) && (this.plotTop = Math.max(this.plotTop, d[0] + c[0]));
                    d[2] && !h(e[2]) && (this.marginBottom = Math.max(this.marginBottom, d[2] + c[2]));
                    this.legend && this.legend.display && this.legend.adjustMargins(e, c);
                    r(this, "getMargins");
                    b || this.getAxisMargins()
                };
                D.prototype.getAxisMargins = function () {
                    var b = this,
                        c = b.axisOffset = [0, 0, 0, 0],
                        e = b.colorAxis,
                        d = b.margin,
                        a = function (b) {
                            b.forEach(function (b) {
                                b.visible && b.getOffset()
                            })
                        };
                    b.hasCartesianSeries ? a(b.axes) : e && e.length && a(e);
                    ca.forEach(function (e, a) {
                        h(d[a]) || (b[e] += c[a])
                    });
                    b.setChartSize()
                };
                D.prototype.reflow = function (b) {
                    var c = this,
                        e = c.options.chart,
                        d = c.renderTo,
                        a = h(e.width) && h(e.height),
                        g = e.width || A(d, "width");
                    e = e.height || A(d, "height");
                    d = b ? b.target : q;
                    if (!a && !c.isPrinting && g && e && (d === q || d === v)) {
                        if (g !== c.containerWidth || e !== c.containerHeight) J.clearTimeout(c.reflowTimeout), c.reflowTimeout = X(function () {
                            c.container && c.setSize(void 0, void 0, !1)
                        }, b ? 100 : 0);
                        c.containerWidth = g;
                        c.containerHeight = e
                    }
                };
                D.prototype.setReflow = function (b) {
                    var c = this;
                    !1 === b || this.unbindReflow ? !1 ===
                        b && this.unbindReflow && (this.unbindReflow = this.unbindReflow()) : (this.unbindReflow = E(q, "resize", function (b) {
                            c.options && c.reflow(b)
                        }), E(this, "destroy", this.unbindReflow))
                };
                D.prototype.setSize = function (b, c, e) {
                    var d = this,
                        a = d.renderer;
                    d.isResizing += 1;
                    W(e, d);
                    e = a.globalAnimation;
                    d.oldChartHeight = d.chartHeight;
                    d.oldChartWidth = d.chartWidth;
                    "undefined" !== typeof b && (d.options.chart.width = b);
                    "undefined" !== typeof c && (d.options.chart.height = c);
                    d.getChartSize();
                    d.styledMode || (e ? p : m)(d.container, {
                        width: d.chartWidth +
                            "px",
                        height: d.chartHeight + "px"
                    }, e);
                    d.setChartSize(!0);
                    a.setSize(d.chartWidth, d.chartHeight, e);
                    d.axes.forEach(function (b) {
                        b.isDirty = !0;
                        b.setScale()
                    });
                    d.isDirtyLegend = !0;
                    d.isDirtyBox = !0;
                    d.layOutTitles();
                    d.getMargins();
                    d.redraw(e);
                    d.oldChartHeight = null;
                    r(d, "resize");
                    X(function () {
                        d && r(d, "endResize", null, function () {
                            --d.isResizing
                        })
                    }, t(e).duration)
                };
                D.prototype.setChartSize = function (b) {
                    var c = this.inverted,
                        e = this.renderer,
                        d = this.chartWidth,
                        a = this.chartHeight,
                        g = this.options.chart,
                        h = this.spacing,
                        k = this.clipOffset,
                        f, l, m, p;
                    this.plotLeft = f = Math.round(this.plotLeft);
                    this.plotTop = l = Math.round(this.plotTop);
                    this.plotWidth = m = Math.max(0, Math.round(d - f - this.marginRight));
                    this.plotHeight = p = Math.max(0, Math.round(a - l - this.marginBottom));
                    this.plotSizeX = c ? p : m;
                    this.plotSizeY = c ? m : p;
                    this.plotBorderWidth = g.plotBorderWidth || 0;
                    this.spacingBox = e.spacingBox = {
                        x: h[3],
                        y: h[0],
                        width: d - h[3] - h[1],
                        height: a - h[0] - h[2]
                    };
                    this.plotBox = e.plotBox = {
                        x: f,
                        y: l,
                        width: m,
                        height: p
                    };
                    d = 2 * Math.floor(this.plotBorderWidth / 2);
                    c = Math.ceil(Math.max(d, k[3]) / 2);
                    e = Math.ceil(Math.max(d, k[0]) / 2);
                    this.clipBox = {
                        x: c,
                        y: e,
                        width: Math.floor(this.plotSizeX - Math.max(d, k[1]) / 2 - c),
                        height: Math.max(0, Math.floor(this.plotSizeY - Math.max(d, k[2]) / 2 - e))
                    };
                    b || this.axes.forEach(function (b) {
                        b.setAxisSize();
                        b.setAxisTranslation()
                    });
                    r(this, "afterSetChartSize", {
                        skipAxes: b
                    })
                };
                D.prototype.resetMargins = function () {
                    r(this, "resetMargins");
                    var b = this,
                        c = b.options.chart;
                    ["margin", "spacing"].forEach(function (e) {
                        var d = c[e],
                            a = R(d) ? d : [d, d, d, d];
                        ["Top", "Right", "Bottom", "Left"].forEach(function (d,
                            g) {
                            b[e][g] = z(c[e + d], a[g])
                        })
                    });
                    ca.forEach(function (c, e) {
                        b[c] = z(b.margin[e], b.spacing[e])
                    });
                    b.axisOffset = [0, 0, 0, 0];
                    b.clipOffset = [0, 0, 0, 0]
                };
                D.prototype.drawChartBox = function () {
                    var b = this.options.chart,
                        c = this.renderer,
                        e = this.chartWidth,
                        d = this.chartHeight,
                        a = this.chartBackground,
                        g = this.plotBackground,
                        h = this.plotBorder,
                        k = this.styledMode,
                        f = this.plotBGImage,
                        l = b.backgroundColor,
                        m = b.plotBackgroundColor,
                        p = b.plotBackgroundImage,
                        w, z = this.plotLeft,
                        t = this.plotTop,
                        B = this.plotWidth,
                        q = this.plotHeight,
                        x = this.plotBox,
                        u = this.clipRect,
                        A = this.clipBox,
                        F = "animate";
                    a || (this.chartBackground = a = c.rect().addClass("highcharts-background").add(), F = "attr");
                    if (k) var n = w = a.strokeWidth();
                    else {
                        n = b.borderWidth || 0;
                        w = n + (b.shadow ? 8 : 0);
                        l = {
                            fill: l || "none"
                        };
                        if (n || a["stroke-width"]) l.stroke = b.borderColor, l["stroke-width"] = n;
                        a.attr(l).shadow(b.shadow)
                    }
                    a[F]({
                        x: w / 2,
                        y: w / 2,
                        width: e - w - n % 2,
                        height: d - w - n % 2,
                        r: b.borderRadius
                    });
                    F = "animate";
                    g || (F = "attr", this.plotBackground = g = c.rect().addClass("highcharts-plot-background").add());
                    g[F](x);
                    k || (g.attr({
                        fill: m ||
                            "none"
                    }).shadow(b.plotShadow), p && (f ? (p !== f.attr("href") && f.attr("href", p), f.animate(x)) : this.plotBGImage = c.image(p, z, t, B, q).add()));
                    u ? u.animate({
                        width: A.width,
                        height: A.height
                    }) : this.clipRect = c.clipRect(A);
                    F = "animate";
                    h || (F = "attr", this.plotBorder = h = c.rect().addClass("highcharts-plot-border").attr({
                        zIndex: 1
                    }).add());
                    k || h.attr({
                        stroke: b.plotBorderColor,
                        "stroke-width": b.plotBorderWidth || 0,
                        fill: "none"
                    });
                    h[F](h.crisp({
                        x: z,
                        y: t,
                        width: B,
                        height: q
                    }, -h.strokeWidth()));
                    this.isDirtyBox = !1;
                    r(this, "afterDrawChartBox")
                };
                D.prototype.propFromSeries = function () {
                    var b = this,
                        c = b.options.chart,
                        e, d = b.options.series,
                        a, g;
                    ["inverted", "angular", "polar"].forEach(function (h) {
                        e = L[c.type || c.defaultSeriesType];
                        g = c[h] || e && e.prototype[h];
                        for (a = d && d.length; !g && a--;)(e = L[d[a].type]) && e.prototype[h] && (g = !0);
                        b[h] = g
                    })
                };
                D.prototype.linkSeries = function () {
                    var b = this,
                        c = b.series;
                    c.forEach(function (b) {
                        b.linkedSeries.length = 0
                    });
                    c.forEach(function (c) {
                        var e = c.options.linkedTo;
                        F(e) && (e = ":previous" === e ? b.series[c.index - 1] : b.get(e)) && e.linkedParent !==
                            c && (e.linkedSeries.push(c), c.linkedParent = e, e.enabledDataSorting && c.setDataSortingOptions(), c.visible = z(c.options.visible, e.options.visible, c.visible))
                    });
                    r(this, "afterLinkSeries")
                };
                D.prototype.renderSeries = function () {
                    this.series.forEach(function (b) {
                        b.translate();
                        b.render()
                    })
                };
                D.prototype.renderLabels = function () {
                    var b = this,
                        c = b.options.labels;
                    c.items && c.items.forEach(function (e) {
                        var a = d(c.style, e.style),
                            g = w(a.left) + b.plotLeft,
                            h = w(a.top) + b.plotTop + 12;
                        delete a.left;
                        delete a.top;
                        b.renderer.text(e.html,
                            g, h).attr({
                            zIndex: 2
                        }).css(a).add()
                    })
                };
                D.prototype.render = function () {
                    var b = this.axes,
                        c = this.colorAxis,
                        e = this.renderer,
                        d = this.options,
                        a = 0,
                        g = function (b) {
                            b.forEach(function (b) {
                                b.visible && b.render()
                            })
                        };
                    this.setTitle();
                    this.legend = new n(this, d.legend);
                    this.getStacks && this.getStacks();
                    this.getMargins(!0);
                    this.setChartSize();
                    d = this.plotWidth;
                    b.some(function (b) {
                        if (b.horiz && b.visible && b.options.labels.enabled && b.series.length) return a = 21, !0
                    });
                    var h = this.plotHeight = Math.max(this.plotHeight - a, 0);
                    b.forEach(function (b) {
                        b.setScale()
                    });
                    this.getAxisMargins();
                    var k = 1.1 < d / this.plotWidth;
                    var l = 1.05 < h / this.plotHeight;
                    if (k || l) b.forEach(function (b) {
                        (b.horiz && k || !b.horiz && l) && b.setTickInterval(!0)
                    }), this.getMargins();
                    this.drawChartBox();
                    this.hasCartesianSeries ? g(b) : c && c.length && g(c);
                    this.seriesGroup || (this.seriesGroup = e.g("series-group").attr({
                        zIndex: 3
                    }).add());
                    this.renderSeries();
                    this.renderLabels();
                    this.addCredits();
                    this.setResponsive && this.setResponsive();
                    this.updateContainerScaling();
                    this.hasRendered = !0
                };
                D.prototype.addCredits = function (b) {
                    var c =
                        this,
                        d = e(!0, this.options.credits, b);
                    d.enabled && !this.credits && (this.credits = this.renderer.text(d.text + (this.mapCredits || ""), 0, 0).addClass("highcharts-credits").on("click", function () {
                        d.href && (q.location.href = d.href)
                    }).attr({
                        align: d.position.align,
                        zIndex: 8
                    }), c.styledMode || this.credits.css(d.style), this.credits.add().align(d.position), this.credits.update = function (b) {
                        c.credits = c.credits.destroy();
                        c.addCredits(b)
                    })
                };
                D.prototype.updateContainerScaling = function () {
                    var b = this.container;
                    if (2 < b.offsetWidth &&
                        2 < b.offsetHeight && b.getBoundingClientRect) {
                        var c = b.getBoundingClientRect(),
                            e = c.width / b.offsetWidth;
                        b = c.height / b.offsetHeight;
                        1 !== e || 1 !== b ? this.containerScaling = {
                            scaleX: e,
                            scaleY: b
                        } : delete this.containerScaling
                    }
                };
                D.prototype.destroy = function () {
                    var c = this,
                        e = c.axes,
                        d = c.series,
                        g = c.container,
                        h, f = g && g.parentNode;
                    r(c, "destroy");
                    c.renderer.forExport ? k(H, c) : H[c.index] = void 0;
                    a.chartCount--;
                    c.renderTo.removeAttribute("data-highcharts-chart");
                    Z(c);
                    for (h = e.length; h--;) e[h] = e[h].destroy();
                    this.scroller && this.scroller.destroy &&
                        this.scroller.destroy();
                    for (h = d.length; h--;) d[h] = d[h].destroy();
                    "title subtitle chartBackground plotBackground plotBGImage plotBorder seriesGroup clipRect credits pointer rangeSelector legend resetZoomButton tooltip renderer".split(" ").forEach(function (b) {
                        var e = c[b];
                        e && e.destroy && (c[b] = e.destroy())
                    });
                    g && (g.innerHTML = "", Z(g), f && l(g));
                    b(c, function (b, e) {
                        delete c[e]
                    })
                };
                D.prototype.firstRender = function () {
                    var b = this,
                        c = b.options;
                    if (!b.isReadyToRender || b.isReadyToRender()) {
                        b.getContainer();
                        b.resetMargins();
                        b.setChartSize();
                        b.propFromSeries();
                        b.getAxes();
                        (N(c.series) ? c.series : []).forEach(function (c) {
                            b.initSeries(c)
                        });
                        b.linkSeries();
                        b.setSeriesData();
                        r(b, "beforeRender");
                        G && (b.pointer = a.hasTouch || !q.PointerEvent && !q.MSPointerEvent ? new G(b, c) : new y(b, c));
                        b.render();
                        if (!b.renderer.imgCount && !b.hasLoaded) b.onload();
                        b.temporaryDisplay(!0)
                    }
                };
                D.prototype.onload = function () {
                    this.callbacks.concat([this.callback]).forEach(function (b) {
                        b && "undefined" !== typeof this.index && b.apply(this, [this])
                    }, this);
                    r(this, "load");
                    r(this, "render");
                    h(this.index) && this.setReflow(this.options.chart.reflow);
                    this.hasLoaded = !0
                };
                return D
            }();
        Y.prototype.callbacks = [];
        a.chart = function (b, c, e) {
            return new Y(b, c, e)
        };
        return a.Chart = Y
    });
    O(n, "Extensions/ScrollablePlotArea.js", [n["Core/Chart/Chart.js"], n["Core/Globals.js"], n["Core/Utilities.js"]], function (f, a, n) {
        var y = n.addEvent,
            D = n.createElement,
            G = n.pick,
            C = n.stop;
        "";
        y(f, "afterSetChartSize", function (f) {
            var n = this.options.chart.scrollablePlotArea,
                v = n && n.minWidth;
            n = n && n.minHeight;
            if (!this.renderer.forExport) {
                if (v) {
                    if (this.scrollablePixelsX =
                        v = Math.max(0, v - this.chartWidth)) {
                        this.plotWidth += v;
                        this.inverted ? (this.clipBox.height += v, this.plotBox.height += v) : (this.clipBox.width += v, this.plotBox.width += v);
                        var C = {
                            1: {
                                name: "right",
                                value: v
                            }
                        }
                    }
                } else n && (this.scrollablePixelsY = v = Math.max(0, n - this.chartHeight)) && (this.plotHeight += v, this.inverted ? (this.clipBox.width += v, this.plotBox.width += v) : (this.clipBox.height += v, this.plotBox.height += v), C = {
                    2: {
                        name: "bottom",
                        value: v
                    }
                });
                C && !f.skipAxes && this.axes.forEach(function (f) {
                    C[f.side] ? f.getPlotLinePath = function () {
                        var q =
                            C[f.side].name,
                            n = this[q];
                        this[q] = n - C[f.side].value;
                        var p = a.Axis.prototype.getPlotLinePath.apply(this, arguments);
                        this[q] = n;
                        return p
                    } : (f.setAxisSize(), f.setAxisTranslation())
                })
            }
        });
        y(f, "render", function () {
            this.scrollablePixelsX || this.scrollablePixelsY ? (this.setUpScrolling && this.setUpScrolling(), this.applyFixed()) : this.fixedDiv && this.applyFixed()
        });
        f.prototype.setUpScrolling = function () {
            var a = this,
                f = {
                    WebkitOverflowScrolling: "touch",
                    overflowX: "hidden",
                    overflowY: "hidden"
                };
            this.scrollablePixelsX && (f.overflowX =
                "auto");
            this.scrollablePixelsY && (f.overflowY = "auto");
            this.scrollingParent = D("div", {
                className: "highcharts-scrolling-parent"
            }, {
                position: "relative"
            }, this.renderTo);
            this.scrollingContainer = D("div", {
                className: "highcharts-scrolling"
            }, f, this.scrollingParent);
            y(this.scrollingContainer, "scroll", function () {
                a.pointer && delete a.pointer.chartPosition
            });
            this.innerContainer = D("div", {
                className: "highcharts-inner-container"
            }, null, this.scrollingContainer);
            this.innerContainer.appendChild(this.container);
            this.setUpScrolling =
                null
        };
        f.prototype.moveFixedElements = function () {
            var a = this.container,
                f = this.fixedRenderer,
                n = ".highcharts-contextbutton .highcharts-credits .highcharts-legend .highcharts-legend-checkbox .highcharts-navigator-series .highcharts-navigator-xaxis .highcharts-navigator-yaxis .highcharts-navigator .highcharts-reset-zoom .highcharts-scrollbar .highcharts-subtitle .highcharts-title".split(" "),
                C;
            this.scrollablePixelsX && !this.inverted ? C = ".highcharts-yaxis" : this.scrollablePixelsX && this.inverted ? C = ".highcharts-xaxis" :
                this.scrollablePixelsY && !this.inverted ? C = ".highcharts-xaxis" : this.scrollablePixelsY && this.inverted && (C = ".highcharts-yaxis");
            n.push(C, C + "-labels");
            n.forEach(function (q) {
                [].forEach.call(a.querySelectorAll(q), function (a) {
                    (a.namespaceURI === f.SVG_NS ? f.box : f.box.parentNode).appendChild(a);
                    a.style.pointerEvents = "auto"
                })
            })
        };
        f.prototype.applyFixed = function () {
            var f, n, v = !this.fixedDiv,
                L = this.options.chart.scrollablePlotArea;
            v ? (this.fixedDiv = D("div", {
                    className: "highcharts-fixed"
                }, {
                    position: "absolute",
                    overflow: "hidden",
                    pointerEvents: "none",
                    zIndex: 2,
                    top: 0
                }, null, !0), null === (f = this.scrollingContainer) || void 0 === f ? void 0 : f.parentNode.insertBefore(this.fixedDiv, this.scrollingContainer), this.renderTo.style.overflow = "visible", this.fixedRenderer = f = new a.Renderer(this.fixedDiv, this.chartWidth, this.chartHeight, null === (n = this.options.chart) || void 0 === n ? void 0 : n.style), this.scrollableMask = f.path().attr({
                    fill: this.options.chart.backgroundColor || "#fff",
                    "fill-opacity": G(L.opacity, .85),
                    zIndex: -1
                }).addClass("highcharts-scrollable-mask").add(),
                this.moveFixedElements(), y(this, "afterShowResetZoom", this.moveFixedElements), y(this, "afterLayOutTitles", this.moveFixedElements)) : this.fixedRenderer.setSize(this.chartWidth, this.chartHeight);
            n = this.chartWidth + (this.scrollablePixelsX || 0);
            f = this.chartHeight + (this.scrollablePixelsY || 0);
            C(this.container);
            this.container.style.width = n + "px";
            this.container.style.height = f + "px";
            this.renderer.boxWrapper.attr({
                width: n,
                height: f,
                viewBox: [0, 0, n, f].join(" ")
            });
            this.chartBackground.attr({
                width: n,
                height: f
            });
            this.scrollingContainer.style.height =
                this.chartHeight + "px";
            v && (L.scrollPositionX && (this.scrollingContainer.scrollLeft = this.scrollablePixelsX * L.scrollPositionX), L.scrollPositionY && (this.scrollingContainer.scrollTop = this.scrollablePixelsY * L.scrollPositionY));
            f = this.axisOffset;
            v = this.plotTop - f[0] - 1;
            L = this.plotLeft - f[3] - 1;
            n = this.plotTop + this.plotHeight + f[2] + 1;
            f = this.plotLeft + this.plotWidth + f[1] + 1;
            var q = this.plotLeft + this.plotWidth - (this.scrollablePixelsX || 0),
                K = this.plotTop + this.plotHeight - (this.scrollablePixelsY || 0);
            v = this.scrollablePixelsX ? [
                ["M", 0, v],
                ["L", this.plotLeft - 1, v],
                ["L", this.plotLeft - 1, n],
                ["L", 0, n],
                ["Z"],
                ["M", q, v],
                ["L", this.chartWidth, v],
                ["L", this.chartWidth, n],
                ["L", q, n],
                ["Z"]
            ] : this.scrollablePixelsY ? [
                ["M", L, 0],
                ["L", L, this.plotTop - 1],
                ["L", f, this.plotTop - 1],
                ["L", f, 0],
                ["Z"],
                ["M", L, K],
                ["L", L, this.chartHeight],
                ["L", f, this.chartHeight],
                ["L", f, K],
                ["Z"]
            ] : [
                ["M", 0, 0]
            ];
            "adjustHeight" !== this.redrawTrigger && this.scrollableMask.attr({
                d: v
            })
        }
    });
    O(n, "Core/Axis/StackingAxis.js", [n["Core/Utilities.js"]], function (f) {
        var a = f.addEvent,
            n = f.destroyObjectProperties,
            y = f.fireEvent,
            D = f.getDeferredAnimation,
            G = f.objectEach,
            C = f.pick,
            J = function () {
                function a(a) {
                    this.oldStacks = {};
                    this.stacks = {};
                    this.stacksTouched = 0;
                    this.axis = a
                }
                a.prototype.buildStacks = function () {
                    var a = this.axis,
                        f = a.series,
                        q = C(a.options.reversedStacks, !0),
                        n = f.length,
                        E;
                    if (!a.isXAxis) {
                        this.usePercentage = !1;
                        for (E = n; E--;) {
                            var p = f[q ? E : n - E - 1];
                            p.setStackedPoints();
                            p.setGroupedPoints()
                        }
                        for (E = 0; E < n; E++) f[E].modifyStacks();
                        y(a, "afterBuildStacks")
                    }
                };
                a.prototype.cleanStacks = function () {
                    if (!this.axis.isXAxis) {
                        if (this.oldStacks) var a =
                            this.stacks = this.oldStacks;
                        G(a, function (a) {
                            G(a, function (a) {
                                a.cumulative = a.total
                            })
                        })
                    }
                };
                a.prototype.resetStacks = function () {
                    var a = this,
                        f = a.stacks;
                    a.axis.isXAxis || G(f, function (f) {
                        G(f, function (q, n) {
                            q.touched < a.stacksTouched ? (q.destroy(), delete f[n]) : (q.total = null, q.cumulative = null)
                        })
                    })
                };
                a.prototype.renderStackTotals = function () {
                    var a = this.axis,
                        f = a.chart,
                        q = f.renderer,
                        n = this.stacks;
                    a = D(f, a.options.stackLabels.animation);
                    var E = this.stackTotalGroup = this.stackTotalGroup || q.g("stack-labels").attr({
                        visibility: "visible",
                        zIndex: 6,
                        opacity: 0
                    }).add();
                    E.translate(f.plotLeft, f.plotTop);
                    G(n, function (a) {
                        G(a, function (a) {
                            a.render(E)
                        })
                    });
                    E.animate({
                        opacity: 1
                    }, a)
                };
                return a
            }();
        return function () {
            function f() {}
            f.compose = function (n) {
                a(n, "init", f.onInit);
                a(n, "destroy", f.onDestroy)
            };
            f.onDestroy = function () {
                var a = this.stacking;
                if (a) {
                    var f = a.stacks;
                    G(f, function (a, v) {
                        n(a);
                        f[v] = null
                    });
                    a && a.stackTotalGroup && a.stackTotalGroup.destroy()
                }
            };
            f.onInit = function () {
                this.stacking || (this.stacking = new J(this))
            };
            return f
        }()
    });
    O(n, "Mixins/LegendSymbol.js",
        [n["Core/Globals.js"], n["Core/Utilities.js"]],
        function (f, a) {
            var n = a.merge,
                y = a.pick;
            return f.LegendSymbolMixin = {
                drawRectangle: function (a, f) {
                    var n = a.symbolHeight,
                        D = a.options.squareSymbol;
                    f.legendSymbol = this.chart.renderer.rect(D ? (a.symbolWidth - n) / 2 : 0, a.baseline - n + 1, D ? n : a.symbolWidth, n, y(a.options.symbolRadius, n / 2)).addClass("highcharts-point").attr({
                        zIndex: 3
                    }).add(f.legendGroup)
                },
                drawLineMarker: function (a) {
                    var f = this.options,
                        C = f.marker,
                        D = a.symbolWidth,
                        H = a.symbolHeight,
                        v = H / 2,
                        L = this.chart.renderer,
                        q =
                        this.legendGroup;
                    a = a.baseline - Math.round(.3 * a.fontMetrics.b);
                    var K = {};
                    this.chart.styledMode || (K = {
                        "stroke-width": f.lineWidth || 0
                    }, f.dashStyle && (K.dashstyle = f.dashStyle));
                    this.legendLine = L.path([
                        ["M", 0, a],
                        ["L", D, a]
                    ]).addClass("highcharts-graph").attr(K).add(q);
                    C && !1 !== C.enabled && D && (f = Math.min(y(C.radius, v), v), 0 === this.symbol.indexOf("url") && (C = n(C, {
                        width: H,
                        height: H
                    }), f = 0), this.legendSymbol = C = L.symbol(this.symbol, D / 2 - f, a - f, 2 * f, 2 * f, C).addClass("highcharts-point").add(q), C.isMarker = !0)
                }
            }
        });
    O(n, "Core/Series/Point.js",
        [n["Core/Globals.js"], n["Core/Utilities.js"]],
        function (f, a) {
            var n = a.animObject,
                y = a.defined,
                D = a.erase,
                G = a.extend,
                C = a.fireEvent,
                J = a.format,
                H = a.getNestedProperty,
                v = a.isArray,
                L = a.isNumber,
                q = a.isObject,
                K = a.syncTimeout,
                E = a.pick,
                p = a.removeEvent,
                t = a.uniqueKey;
            "";
            a = function () {
                function a() {
                    this.colorIndex = this.category = void 0;
                    this.formatPrefix = "point";
                    this.id = void 0;
                    this.isNull = !1;
                    this.percentage = this.options = this.name = void 0;
                    this.selected = !1;
                    this.total = this.series = void 0;
                    this.visible = !0;
                    this.x = void 0
                }
                a.prototype.animateBeforeDestroy =
                    function () {
                        var a = this,
                            f = {
                                x: a.startXPos,
                                opacity: 0
                            },
                            h, l = a.getGraphicalProps();
                        l.singular.forEach(function (k) {
                            h = "dataLabel" === k;
                            a[k] = a[k].animate(h ? {
                                x: a[k].startXPos,
                                y: a[k].startYPos,
                                opacity: 0
                            } : f)
                        });
                        l.plural.forEach(function (h) {
                            a[h].forEach(function (g) {
                                g.element && g.animate(G({
                                    x: a.startXPos
                                }, g.startYPos ? {
                                    x: g.startXPos,
                                    y: g.startYPos
                                } : {}))
                            })
                        })
                    };
                a.prototype.applyOptions = function (f, m) {
                    var h = this.series,
                        l = h.options.pointValKey || h.pointValKey;
                    f = a.prototype.optionsToObject.call(this, f);
                    G(this, f);
                    this.options =
                        this.options ? G(this.options, f) : f;
                    f.group && delete this.group;
                    f.dataLabels && delete this.dataLabels;
                    l && (this.y = a.prototype.getNestedProperty.call(this, l));
                    this.formatPrefix = (this.isNull = E(this.isValid && !this.isValid(), null === this.x || !L(this.y))) ? "null" : "point";
                    this.selected && (this.state = "select");
                    "name" in this && "undefined" === typeof m && h.xAxis && h.xAxis.hasNames && (this.x = h.xAxis.nameToX(this));
                    "undefined" === typeof this.x && h && (this.x = "undefined" === typeof m ? h.autoIncrement(this) : m);
                    return this
                };
                a.prototype.destroy =
                    function () {
                        function a() {
                            if (f.graphic || f.dataLabel || f.dataLabels) p(f), f.destroyElements();
                            for (d in f) f[d] = null
                        }
                        var f = this,
                            h = f.series,
                            l = h.chart;
                        h = h.options.dataSorting;
                        var k = l.hoverPoints,
                            g = n(f.series.chart.renderer.globalAnimation),
                            d;
                        f.legendItem && l.legend.destroyItem(f);
                        k && (f.setState(), D(k, f), k.length || (l.hoverPoints = null));
                        if (f === l.hoverPoint) f.onMouseOut();
                        h && h.enabled ? (this.animateBeforeDestroy(), K(a, g.duration)) : a();
                        l.pointCount--
                    };
                a.prototype.destroyElements = function (a) {
                    var f = this;
                    a = f.getGraphicalProps(a);
                    a.singular.forEach(function (a) {
                        f[a] = f[a].destroy()
                    });
                    a.plural.forEach(function (a) {
                        f[a].forEach(function (a) {
                            a.element && a.destroy()
                        });
                        delete f[a]
                    })
                };
                a.prototype.firePointEvent = function (a, f, h) {
                    var l = this,
                        k = this.series.options;
                    (k.point.events[a] || l.options && l.options.events && l.options.events[a]) && l.importEvents();
                    "click" === a && k.allowPointSelect && (h = function (a) {
                        l.select && l.select(null, a.ctrlKey || a.metaKey || a.shiftKey)
                    });
                    C(l, a, f, h)
                };
                a.prototype.getClassName = function () {
                    return "highcharts-point" + (this.selected ?
                        " highcharts-point-select" : "") + (this.negative ? " highcharts-negative" : "") + (this.isNull ? " highcharts-null-point" : "") + ("undefined" !== typeof this.colorIndex ? " highcharts-color-" + this.colorIndex : "") + (this.options.className ? " " + this.options.className : "") + (this.zone && this.zone.className ? " " + this.zone.className.replace("highcharts-negative", "") : "")
                };
                a.prototype.getGraphicalProps = function (a) {
                    var f = this,
                        h = [],
                        l, k = {
                            singular: [],
                            plural: []
                        };
                    a = a || {
                        graphic: 1,
                        dataLabel: 1
                    };
                    a.graphic && h.push("graphic", "shadowGroup");
                    a.dataLabel && h.push("dataLabel", "dataLabelUpper", "connector");
                    for (l = h.length; l--;) {
                        var g = h[l];
                        f[g] && k.singular.push(g)
                    } ["dataLabel", "connector"].forEach(function (d) {
                        var g = d + "s";
                        a[d] && f[g] && k.plural.push(g)
                    });
                    return k
                };
                a.prototype.getLabelConfig = function () {
                    return {
                        x: this.category,
                        y: this.y,
                        color: this.color,
                        colorIndex: this.colorIndex,
                        key: this.name || this.category,
                        series: this.series,
                        point: this,
                        percentage: this.percentage,
                        total: this.total || this.stackTotal
                    }
                };
                a.prototype.getNestedProperty = function (a) {
                    if (a) return 0 ===
                        a.indexOf("custom.") ? H(a, this.options) : this[a]
                };
                a.prototype.getZone = function () {
                    var a = this.series,
                        f = a.zones;
                    a = a.zoneAxis || "y";
                    var h = 0,
                        l;
                    for (l = f[h]; this[a] >= l.value;) l = f[++h];
                    this.nonZonedColor || (this.nonZonedColor = this.color);
                    this.color = l && l.color && !this.options.color ? l.color : this.nonZonedColor;
                    return l
                };
                a.prototype.hasNewShapeType = function () {
                    return (this.graphic && (this.graphic.symbolName || this.graphic.element.nodeName)) !== this.shapeType
                };
                a.prototype.init = function (a, f, h) {
                    this.series = a;
                    this.applyOptions(f,
                        h);
                    this.id = y(this.id) ? this.id : t();
                    this.resolveColor();
                    a.chart.pointCount++;
                    C(this, "afterInit");
                    return this
                };
                a.prototype.optionsToObject = function (f) {
                    var m = {},
                        h = this.series,
                        l = h.options.keys,
                        k = l || h.pointArrayMap || ["y"],
                        g = k.length,
                        d = 0,
                        p = 0;
                    if (L(f) || null === f) m[k[0]] = f;
                    else if (v(f))
                        for (!l && f.length > g && (h = typeof f[0], "string" === h ? m.name = f[0] : "number" === h && (m.x = f[0]), d++); p < g;) l && "undefined" === typeof f[d] || (0 < k[p].indexOf(".") ? a.prototype.setNestedProperty(m, f[d], k[p]) : m[k[p]] = f[d]), d++, p++;
                    else "object" ===
                        typeof f && (m = f, f.dataLabels && (h._hasPointLabels = !0), f.marker && (h._hasPointMarkers = !0));
                    return m
                };
                a.prototype.resolveColor = function () {
                    var a = this.series;
                    var f = a.chart.options.chart.colorCount;
                    var h = a.chart.styledMode;
                    delete this.nonZonedColor;
                    h || this.options.color || (this.color = a.color);
                    a.options.colorByPoint ? (h || (f = a.options.colors || a.chart.options.colors, this.color = this.color || f[a.colorCounter], f = f.length), h = a.colorCounter, a.colorCounter++, a.colorCounter === f && (a.colorCounter = 0)) : h = a.colorIndex;
                    this.colorIndex =
                        E(this.colorIndex, h)
                };
                a.prototype.setNestedProperty = function (a, f, h) {
                    h.split(".").reduce(function (a, h, g, d) {
                        a[h] = d.length - 1 === g ? f : q(a[h], !0) ? a[h] : {};
                        return a[h]
                    }, a);
                    return a
                };
                a.prototype.tooltipFormatter = function (a) {
                    var f = this.series,
                        h = f.tooltipOptions,
                        l = E(h.valueDecimals, ""),
                        k = h.valuePrefix || "",
                        g = h.valueSuffix || "";
                    f.chart.styledMode && (a = f.chart.tooltip.styledModeFormat(a));
                    (f.pointArrayMap || ["y"]).forEach(function (d) {
                        d = "{point." + d;
                        if (k || g) a = a.replace(RegExp(d + "}", "g"), k + d + "}" + g);
                        a = a.replace(RegExp(d +
                            "}", "g"), d + ":,." + l + "f}")
                    });
                    return J(a, {
                        point: this,
                        series: this.series
                    }, f.chart)
                };
                return a
            }();
            return f.Point = a
        });
    O(n, "Core/Series/Series.js", [n["Core/Globals.js"], n["Mixins/LegendSymbol.js"], n["Core/Options.js"], n["Core/Series/Point.js"], n["Core/Renderer/SVG/SVGElement.js"], n["Core/Utilities.js"]], function (f, a, n, y, D, G) {
        var C = n.defaultOptions,
            J = G.addEvent,
            H = G.animObject,
            v = G.arrayMax,
            L = G.arrayMin,
            q = G.clamp,
            K = G.correctFloat,
            E = G.defined,
            p = G.erase,
            t = G.error,
            I = G.extend,
            u = G.find,
            m = G.fireEvent,
            h = G.getNestedProperty,
            l = G.isArray,
            k = G.isFunction,
            g = G.isNumber,
            d = G.isString,
            x = G.merge,
            r = G.objectEach,
            A = G.pick,
            N = G.removeEvent;
        n = G.seriesType;
        var B = G.splat,
            M = G.syncTimeout;
        "";
        var R = f.seriesTypes,
            F = f.win;
        f.Series = n("line", null, {
            lineWidth: 2,
            allowPointSelect: !1,
            crisp: !0,
            showCheckbox: !1,
            animation: {
                duration: 1E3
            },
            events: {},
            marker: {
                enabledThreshold: 2,
                lineColor: "#ffffff",
                lineWidth: 0,
                radius: 4,
                states: {
                    normal: {
                        animation: !0
                    },
                    hover: {
                        animation: {
                            duration: 50
                        },
                        enabled: !0,
                        radiusPlus: 2,
                        lineWidthPlus: 1
                    },
                    select: {
                        fillColor: "#cccccc",
                        lineColor: "#000000",
                        lineWidth: 2
                    }
                }
            },
            point: {
                events: {}
            },
            dataLabels: {
                animation: {},
                align: "center",
                defer: !0,
                formatter: function () {
                    var e = this.series.chart.numberFormatter;
                    return "number" !== typeof this.y ? "" : e(this.y, -1)
                },
                padding: 5,
                style: {
                    fontSize: "11px",
                    fontWeight: "bold",
                    color: "contrast",
                    textOutline: "1px contrast"
                },
                verticalAlign: "bottom",
                x: 0,
                y: 0
            },
            cropThreshold: 300,
            opacity: 1,
            pointRange: 0,
            softThreshold: !0,
            states: {
                normal: {
                    animation: !0
                },
                hover: {
                    animation: {
                        duration: 50
                    },
                    lineWidthPlus: 1,
                    marker: {},
                    halo: {
                        size: 10,
                        opacity: .25
                    }
                },
                select: {
                    animation: {
                        duration: 0
                    }
                },
                inactive: {
                    animation: {
                        duration: 50
                    },
                    opacity: .2
                }
            },
            stickyTracking: !0,
            turboThreshold: 1E3,
            findNearestPointBy: "x"
        }, {
            axisTypes: ["xAxis", "yAxis"],
            coll: "series",
            colorCounter: 0,
            cropShoulder: 1,
            directTouch: !1,
            isCartesian: !0,
            parallelArrays: ["x", "y"],
            pointClass: y,
            requireSorting: !0,
            sorted: !0,
            init: function (e, c) {
                m(this, "init", {
                    options: c
                });
                var b = this,
                    a = e.series,
                    d;
                this.eventOptions = this.eventOptions || {};
                this.eventsToUnbind = [];
                b.chart = e;
                b.options = c = b.setOptions(c);
                b.linkedSeries = [];
                b.bindAxes();
                I(b, {
                    name: c.name,
                    state: "",
                    visible: !1 !== c.visible,
                    selected: !0 === c.selected
                });
                var g = c.events;
                r(g, function (c, e) {
                    k(c) && b.eventOptions[e] !== c && (k(b.eventOptions[e]) && N(b, e, b.eventOptions[e]), b.eventOptions[e] = c, J(b, e, c))
                });
                if (g && g.click || c.point && c.point.events && c.point.events.click || c.allowPointSelect) e.runTrackerClick = !0;
                b.getColor();
                b.getSymbol();
                b.parallelArrays.forEach(function (c) {
                    b[c + "Data"] || (b[c + "Data"] = [])
                });
                b.isCartesian && (e.hasCartesianSeries = !0);
                a.length && (d = a[a.length - 1]);
                b._i = A(d && d._i, -1) + 1;
                b.opacity = b.options.opacity;
                e.orderSeries(this.insert(a));
                c.dataSorting && c.dataSorting.enabled ? b.setDataSortingOptions() : b.points || b.data || b.setData(c.data, !1);
                m(this, "afterInit")
            },
            is: function (e) {
                return R[e] && this instanceof R[e]
            },
            insert: function (e) {
                var c = this.options.index,
                    b;
                if (g(c)) {
                    for (b = e.length; b--;)
                        if (c >= A(e[b].options.index, e[b]._i)) {
                            e.splice(b + 1, 0, this);
                            break
                        } - 1 === b && e.unshift(this);
                    b += 1
                } else e.push(this);
                return A(b, e.length - 1)
            },
            bindAxes: function () {
                var e = this,
                    c = e.options,
                    b = e.chart,
                    a;
                m(this, "bindAxes", null, function () {
                    (e.axisTypes || []).forEach(function (d) {
                        b[d].forEach(function (b) {
                            a = b.options;
                            if (c[d] === a.index || "undefined" !== typeof c[d] && c[d] === a.id || "undefined" === typeof c[d] && 0 === a.index) e.insert(b.series), e[d] = b, b.isDirty = !0
                        });
                        e[d] || e.optionalAxis === d || t(18, !0, b)
                    })
                });
                m(this, "afterBindAxes")
            },
            updateParallelArrays: function (e, c) {
                var b = e.series,
                    a = arguments,
                    d = g(c) ? function (a) {
                        var d = "y" === a && b.toYData ? b.toYData(e) : e[a];
                        b[a + "Data"][c] = d
                    } : function (e) {
                        Array.prototype[c].apply(b[e + "Data"], Array.prototype.slice.call(a, 2))
                    };
                b.parallelArrays.forEach(d)
            },
            hasData: function () {
                return this.visible && "undefined" !== typeof this.dataMax && "undefined" !== typeof this.dataMin || this.visible && this.yData && 0 < this.yData.length
            },
            autoIncrement: function () {
                var e = this.options,
                    c = this.xIncrement,
                    b, a = e.pointIntervalUnit,
                    d = this.chart.time;
                c = A(c, e.pointStart, 0);
                this.pointInterval = b = A(this.pointInterval, e.pointInterval, 1);
                a && (e = new d.Date(c), "day" === a ? d.set("Date", e, d.get("Date", e) + b) : "month" === a ? d.set("Month", e, d.get("Month", e) + b) : "year" === a && d.set("FullYear", e, d.get("FullYear",
                    e) + b), b = e.getTime() - c);
                this.xIncrement = c + b;
                return c
            },
            setDataSortingOptions: function () {
                var e = this.options;
                I(this, {
                    requireSorting: !1,
                    sorted: !1,
                    enabledDataSorting: !0,
                    allowDG: !1
                });
                E(e.pointRange) || (e.pointRange = 1)
            },
            setOptions: function (e) {
                var c = this.chart,
                    b = c.options,
                    a = b.plotOptions,
                    d = c.userOptions || {};
                e = x(e);
                c = c.styledMode;
                var g = {
                    plotOptions: a,
                    userOptions: e
                };
                m(this, "setOptions", g);
                var h = g.plotOptions[this.type],
                    f = d.plotOptions || {};
                this.userOptions = g.userOptions;
                d = x(h, a.series, d.plotOptions && d.plotOptions[this.type],
                    e);
                this.tooltipOptions = x(C.tooltip, C.plotOptions.series && C.plotOptions.series.tooltip, C.plotOptions[this.type].tooltip, b.tooltip.userOptions, a.series && a.series.tooltip, a[this.type].tooltip, e.tooltip);
                this.stickyTracking = A(e.stickyTracking, f[this.type] && f[this.type].stickyTracking, f.series && f.series.stickyTracking, this.tooltipOptions.shared && !this.noSharedTooltip ? !0 : d.stickyTracking);
                null === h.marker && delete d.marker;
                this.zoneAxis = d.zoneAxis;
                b = this.zones = (d.zones || []).slice();
                !d.negativeColor && !d.negativeFillColor ||
                    d.zones || (a = {
                        value: d[this.zoneAxis + "Threshold"] || d.threshold || 0,
                        className: "highcharts-negative"
                    }, c || (a.color = d.negativeColor, a.fillColor = d.negativeFillColor), b.push(a));
                b.length && E(b[b.length - 1].value) && b.push(c ? {} : {
                    color: this.color,
                    fillColor: this.fillColor
                });
                m(this, "afterSetOptions", {
                    options: d
                });
                return d
            },
            getName: function () {
                return A(this.options.name, "Series " + (this.index + 1))
            },
            getCyclic: function (e, c, b) {
                var a = this.chart,
                    d = this.userOptions,
                    g = e + "Index",
                    h = e + "Counter",
                    f = b ? b.length : A(a.options.chart[e +
                        "Count"], a[e + "Count"]);
                if (!c) {
                    var k = A(d[g], d["_" + g]);
                    E(k) || (a.series.length || (a[h] = 0), d["_" + g] = k = a[h] % f, a[h] += 1);
                    b && (c = b[k])
                }
                "undefined" !== typeof k && (this[g] = k);
                this[e] = c
            },
            getColor: function () {
                this.chart.styledMode ? this.getCyclic("color") : this.options.colorByPoint ? this.options.color = null : this.getCyclic("color", this.options.color || C.plotOptions[this.type].color, this.chart.options.colors)
            },
            getPointsCollection: function () {
                return (this.hasGroupedData ? this.points : this.data) || []
            },
            getSymbol: function () {
                this.getCyclic("symbol",
                    this.options.marker.symbol, this.chart.options.symbols)
            },
            findPointIndex: function (e, c) {
                var b = e.id,
                    a = e.x,
                    d = this.points,
                    h, f = this.options.dataSorting;
                if (b) var k = this.chart.get(b);
                else if (this.linkedParent || this.enabledDataSorting) {
                    var l = f && f.matchByName ? "name" : "index";
                    k = u(d, function (b) {
                        return !b.touched && b[l] === e[l]
                    });
                    if (!k) return
                }
                if (k) {
                    var m = k && k.index;
                    "undefined" !== typeof m && (h = !0)
                }
                "undefined" === typeof m && g(a) && (m = this.xData.indexOf(a, c)); - 1 !== m && "undefined" !== typeof m && this.cropped && (m = m >= this.cropStart ?
                    m - this.cropStart : m);
                !h && d[m] && d[m].touched && (m = void 0);
                return m
            },
            drawLegendSymbol: a.drawLineMarker,
            updateData: function (e, c) {
                var b = this.options,
                    a = b.dataSorting,
                    d = this.points,
                    h = [],
                    f, k, l, m = this.requireSorting,
                    p = e.length === d.length,
                    r = !0;
                this.xIncrement = null;
                e.forEach(function (c, e) {
                    var k = E(c) && this.pointClass.prototype.optionsToObject.call({
                        series: this
                    }, c) || {};
                    var w = k.x;
                    if (k.id || g(w)) {
                        if (w = this.findPointIndex(k, l), -1 === w || "undefined" === typeof w ? h.push(c) : d[w] && c !== b.data[w] ? (d[w].update(c, !1, null, !1),
                                d[w].touched = !0, m && (l = w + 1)) : d[w] && (d[w].touched = !0), !p || e !== w || a && a.enabled || this.hasDerivedData) f = !0
                    } else h.push(c)
                }, this);
                if (f)
                    for (e = d.length; e--;)(k = d[e]) && !k.touched && k.remove && k.remove(!1, c);
                else !p || a && a.enabled ? r = !1 : (e.forEach(function (b, c) {
                    d[c].update && b !== d[c].y && d[c].update(b, !1, null, !1)
                }), h.length = 0);
                d.forEach(function (b) {
                    b && (b.touched = !1)
                });
                if (!r) return !1;
                h.forEach(function (b) {
                    this.addPoint(b, !1, null, null, !1)
                }, this);
                null === this.xIncrement && this.xData && this.xData.length && (this.xIncrement =
                    v(this.xData), this.autoIncrement());
                return !0
            },
            setData: function (e, c, b, a) {
                var h = this,
                    f = h.points,
                    k = f && f.length || 0,
                    m, p = h.options,
                    r = h.chart,
                    B = p.dataSorting,
                    z = null,
                    n = h.xAxis;
                z = p.turboThreshold;
                var q = this.xData,
                    x = this.yData,
                    F = (m = h.pointArrayMap) && m.length,
                    M = p.keys,
                    v = 0,
                    u = 1,
                    I;
                e = e || [];
                m = e.length;
                c = A(c, !0);
                B && B.enabled && (e = this.sortData(e));
                !1 !== a && m && k && !h.cropped && !h.hasGroupedData && h.visible && !h.isSeriesBoosting && (I = this.updateData(e, b));
                if (!I) {
                    h.xIncrement = null;
                    h.colorCounter = 0;
                    this.parallelArrays.forEach(function (b) {
                        h[b +
                            "Data"].length = 0
                    });
                    if (z && m > z)
                        if (z = h.getFirstValidPoint(e), g(z))
                            for (b = 0; b < m; b++) q[b] = this.autoIncrement(), x[b] = e[b];
                        else if (l(z))
                        if (F)
                            for (b = 0; b < m; b++) a = e[b], q[b] = a[0], x[b] = a.slice(1, F + 1);
                        else
                            for (M && (v = M.indexOf("x"), u = M.indexOf("y"), v = 0 <= v ? v : 0, u = 0 <= u ? u : 1), b = 0; b < m; b++) a = e[b], q[b] = a[v], x[b] = a[u];
                    else t(12, !1, r);
                    else
                        for (b = 0; b < m; b++) "undefined" !== typeof e[b] && (a = {
                            series: h
                        }, h.pointClass.prototype.applyOptions.apply(a, [e[b]]), h.updateParallelArrays(a, b));
                    x && d(x[0]) && t(14, !0, r);
                    h.data = [];
                    h.options.data =
                        h.userOptions.data = e;
                    for (b = k; b--;) f[b] && f[b].destroy && f[b].destroy();
                    n && (n.minRange = n.userMinRange);
                    h.isDirty = r.isDirtyBox = !0;
                    h.isDirtyData = !!f;
                    b = !1
                }
                "point" === p.legendType && (this.processData(), this.generatePoints());
                c && r.redraw(b)
            },
            sortData: function (e) {
                var c = this,
                    b = c.options.dataSorting.sortKey || "y",
                    a = function (b, c) {
                        return E(c) && b.pointClass.prototype.optionsToObject.call({
                            series: b
                        }, c) || {}
                    };
                e.forEach(function (b, d) {
                    e[d] = a(c, b);
                    e[d].index = d
                }, this);
                e.concat().sort(function (c, e) {
                    c = h(b, c);
                    e = h(b, e);
                    return e <
                        c ? -1 : e > c ? 1 : 0
                }).forEach(function (b, c) {
                    b.x = c
                }, this);
                c.linkedSeries && c.linkedSeries.forEach(function (b) {
                    var c = b.options,
                        d = c.data;
                    c.dataSorting && c.dataSorting.enabled || !d || (d.forEach(function (c, g) {
                        d[g] = a(b, c);
                        e[g] && (d[g].x = e[g].x, d[g].index = g)
                    }), b.setData(d, !1))
                });
                return e
            },
            getProcessedData: function (e) {
                var c = this.xData,
                    b = this.yData,
                    a = c.length;
                var d = 0;
                var g = this.xAxis,
                    h = this.options;
                var f = h.cropThreshold;
                var k = e || this.getExtremesFromAll || h.getExtremesFromAll,
                    l = this.isCartesian;
                e = g && g.val2lin;
                h = !(!g || !g.logarithmic);
                var m = this.requireSorting;
                if (g) {
                    g = g.getExtremes();
                    var p = g.min;
                    var r = g.max
                }
                if (l && this.sorted && !k && (!f || a > f || this.forceCrop))
                    if (c[a - 1] < p || c[0] > r) c = [], b = [];
                    else if (this.yData && (c[0] < p || c[a - 1] > r)) {
                    d = this.cropData(this.xData, this.yData, p, r);
                    c = d.xData;
                    b = d.yData;
                    d = d.start;
                    var B = !0
                }
                for (f = c.length || 1; --f;)
                    if (a = h ? e(c[f]) - e(c[f - 1]) : c[f] - c[f - 1], 0 < a && ("undefined" === typeof n || a < n)) var n = a;
                    else 0 > a && m && (t(15, !1, this.chart), m = !1);
                return {
                    xData: c,
                    yData: b,
                    cropped: B,
                    cropStart: d,
                    closestPointRange: n
                }
            },
            processData: function (e) {
                var c =
                    this.xAxis;
                if (this.isCartesian && !this.isDirty && !c.isDirty && !this.yAxis.isDirty && !e) return !1;
                e = this.getProcessedData();
                this.cropped = e.cropped;
                this.cropStart = e.cropStart;
                this.processedXData = e.xData;
                this.processedYData = e.yData;
                this.closestPointRange = this.basePointRange = e.closestPointRange
            },
            cropData: function (e, c, b, a, d) {
                var g = e.length,
                    h = 0,
                    f = g,
                    k;
                d = A(d, this.cropShoulder);
                for (k = 0; k < g; k++)
                    if (e[k] >= b) {
                        h = Math.max(0, k - d);
                        break
                    } for (b = k; b < g; b++)
                    if (e[b] > a) {
                        f = b + d;
                        break
                    } return {
                    xData: e.slice(h, f),
                    yData: c.slice(h, f),
                    start: h,
                    end: f
                }
            },
            generatePoints: function () {
                var e = this.options,
                    c = e.data,
                    b = this.data,
                    a, d = this.processedXData,
                    g = this.processedYData,
                    h = this.pointClass,
                    f = d.length,
                    k = this.cropStart || 0,
                    l = this.hasGroupedData;
                e = e.keys;
                var p = [],
                    r;
                b || l || (b = [], b.length = c.length, b = this.data = b);
                e && l && (this.options.keys = !1);
                for (r = 0; r < f; r++) {
                    var t = k + r;
                    if (l) {
                        var n = (new h).init(this, [d[r]].concat(B(g[r])));
                        n.dataGroup = this.groupMap[r];
                        n.dataGroup.options && (n.options = n.dataGroup.options, I(n, n.dataGroup.options), delete n.dataLabels)
                    } else(n =
                        b[t]) || "undefined" === typeof c[t] || (b[t] = n = (new h).init(this, c[t], d[r]));
                    n && (n.index = t, p[r] = n)
                }
                this.options.keys = e;
                if (b && (f !== (a = b.length) || l))
                    for (r = 0; r < a; r++) r !== k || l || (r += f), b[r] && (b[r].destroyElements(), b[r].plotX = void 0);
                this.data = b;
                this.points = p;
                m(this, "afterGeneratePoints")
            },
            getXExtremes: function (e) {
                return {
                    min: L(e),
                    max: v(e)
                }
            },
            getExtremes: function (e, c) {
                var b = this.xAxis,
                    a = this.yAxis,
                    d = this.processedXData || this.xData,
                    h = [],
                    f = 0,
                    k = 0;
                var p = 0;
                var r = this.requireSorting ? this.cropShoulder : 0,
                    t = a ? a.positiveValuesOnly :
                    !1,
                    B;
                e = e || this.stackedYData || this.processedYData || [];
                a = e.length;
                b && (p = b.getExtremes(), k = p.min, p = p.max);
                for (B = 0; B < a; B++) {
                    var n = d[B];
                    var q = e[B];
                    var x = (g(q) || l(q)) && (q.length || 0 < q || !t);
                    n = c || this.getExtremesFromAll || this.options.getExtremesFromAll || this.cropped || !b || (d[B + r] || n) >= k && (d[B - r] || n) <= p;
                    if (x && n)
                        if (x = q.length)
                            for (; x--;) g(q[x]) && (h[f++] = q[x]);
                        else h[f++] = q
                }
                e = {
                    dataMin: L(h),
                    dataMax: v(h)
                };
                m(this, "afterGetExtremes", {
                    dataExtremes: e
                });
                return e
            },
            applyExtremes: function () {
                var e = this.getExtremes();
                this.dataMin =
                    e.dataMin;
                this.dataMax = e.dataMax;
                return e
            },
            getFirstValidPoint: function (e) {
                for (var c = null, b = e.length, a = 0; null === c && a < b;) c = e[a], a++;
                return c
            },
            translate: function () {
                this.processedXData || this.processData();
                this.generatePoints();
                var e = this.options,
                    c = e.stacking,
                    b = this.xAxis,
                    a = b.categories,
                    d = this.enabledDataSorting,
                    h = this.yAxis,
                    f = this.points,
                    k = f.length,
                    p = !!this.modifyValue,
                    r, t = this.pointPlacementToXValue(),
                    B = !!t,
                    n = e.threshold,
                    x = e.startFromThreshold ? n : 0,
                    F, M = this.zoneAxis || "y",
                    v = Number.MAX_VALUE;
                for (r = 0; r <
                    k; r++) {
                    var u = f[r],
                        I = u.x,
                        C = u.y,
                        H = u.low,
                        R = c && h.stacking && h.stacking.stacks[(this.negStacks && C < (x ? 0 : n) ? "-" : "") + this.stackKey];
                    if (h.positiveValuesOnly && !h.validatePositiveValue(C) || b.positiveValuesOnly && !b.validatePositiveValue(I)) u.isNull = !0;
                    u.plotX = F = K(q(b.translate(I, 0, 0, 0, 1, t, "flags" === this.type), -1E5, 1E5));
                    if (c && this.visible && R && R[I]) {
                        var y = this.getStackIndicator(y, I, this.index);
                        if (!u.isNull) {
                            var N = R[I];
                            var D = N.points[y.key]
                        }
                    }
                    l(D) && (H = D[0], C = D[1], H === x && y.key === R[I].base && (H = A(g(n) && n, h.min)), h.positiveValuesOnly &&
                        0 >= H && (H = null), u.total = u.stackTotal = N.total, u.percentage = N.total && u.y / N.total * 100, u.stackY = C, this.irregularWidths || N.setOffset(this.pointXOffset || 0, this.barW || 0));
                    u.yBottom = E(H) ? q(h.translate(H, 0, 1, 0, 1), -1E5, 1E5) : null;
                    p && (C = this.modifyValue(C, u));
                    u.plotY = "number" === typeof C && Infinity !== C ? q(h.translate(C, 0, 1, 0, 1), -1E5, 1E5) : void 0;
                    u.isInside = this.isPointInside(u);
                    u.clientX = B ? K(b.translate(I, 0, 0, 0, 1, t)) : F;
                    u.negative = u[M] < (e[M + "Threshold"] || n || 0);
                    u.category = a && "undefined" !== typeof a[u.x] ? a[u.x] : u.x;
                    if (!u.isNull &&
                        !1 !== u.visible) {
                        "undefined" !== typeof G && (v = Math.min(v, Math.abs(F - G)));
                        var G = F
                    }
                    u.zone = this.zones.length && u.getZone();
                    !u.graphic && this.group && d && (u.isNew = !0)
                }
                this.closestPointRangePx = v;
                m(this, "afterTranslate")
            },
            getValidPoints: function (e, c, b) {
                var a = this.chart;
                return (e || this.points || []).filter(function (e) {
                    return c && !a.isInsidePlot(e.plotX, e.plotY, a.inverted) ? !1 : !1 !== e.visible && (b || !e.isNull)
                })
            },
            getClipBox: function (e, c) {
                var b = this.options,
                    a = this.chart,
                    d = a.inverted,
                    g = this.xAxis,
                    h = g && this.yAxis,
                    f = a.options.chart.scrollablePlotArea || {};
                e && !1 === b.clip && h ? e = d ? {
                    y: -a.chartWidth + h.len + h.pos,
                    height: a.chartWidth,
                    width: a.chartHeight,
                    x: -a.chartHeight + g.len + g.pos
                } : {
                    y: -h.pos,
                    height: a.chartHeight,
                    width: a.chartWidth,
                    x: -g.pos
                } : (e = this.clipBox || a.clipBox, c && (e.width = a.plotSizeX, e.x = (a.scrollablePixelsX || 0) * (f.scrollPositionX || 0)));
                return c ? {
                    width: e.width,
                    x: e.x
                } : e
            },
            setClip: function (e) {
                var c = this.chart,
                    b = this.options,
                    a = c.renderer,
                    d = c.inverted,
                    g = this.clipBox,
                    h = this.getClipBox(e),
                    f = this.sharedClipKey || ["_sharedClip", e && e.duration, e && e.easing, h.height,
                        b.xAxis, b.yAxis
                    ].join(),
                    k = c[f],
                    l = c[f + "m"];
                e && (h.width = 0, d && (h.x = c.plotHeight + (!1 !== b.clip ? 0 : c.plotTop)));
                k ? c.hasLoaded || k.attr(h) : (e && (c[f + "m"] = l = a.clipRect(d ? c.plotSizeX + 99 : -99, d ? -c.plotLeft : -c.plotTop, 99, d ? c.chartWidth : c.chartHeight)), c[f] = k = a.clipRect(h), k.count = {
                    length: 0
                });
                e && !k.count[this.index] && (k.count[this.index] = !0, k.count.length += 1);
                if (!1 !== b.clip || e) this.group.clip(e || g ? k : c.clipRect), this.markerGroup.clip(l), this.sharedClipKey = f;
                e || (k.count[this.index] && (delete k.count[this.index], --k.count.length),
                    0 === k.count.length && f && c[f] && (g || (c[f] = c[f].destroy()), c[f + "m"] && (c[f + "m"] = c[f + "m"].destroy())))
            },
            animate: function (e) {
                var c = this.chart,
                    b = H(this.options.animation);
                if (!c.hasRendered)
                    if (e) this.setClip(b);
                    else {
                        var a = this.sharedClipKey;
                        e = c[a];
                        var d = this.getClipBox(b, !0);
                        e && e.animate(d, b);
                        c[a + "m"] && c[a + "m"].animate({
                            width: d.width + 99,
                            x: d.x - (c.inverted ? 0 : 99)
                        }, b)
                    }
            },
            afterAnimate: function () {
                this.setClip();
                m(this, "afterAnimate");
                this.finishedAnimating = !0
            },
            drawPoints: function () {
                var e = this.points,
                    c = this.chart,
                    b, a, d = this.options.marker,
                    g = this[this.specialGroup] || this.markerGroup,
                    h = this.xAxis,
                    f = A(d.enabled, !h || h.isRadial ? !0 : null, this.closestPointRangePx >= d.enabledThreshold * d.radius);
                if (!1 !== d.enabled || this._hasPointMarkers)
                    for (b = 0; b < e.length; b++) {
                        var k = e[b];
                        var l = (a = k.graphic) ? "animate" : "attr";
                        var m = k.marker || {};
                        var p = !!k.marker;
                        if ((f && "undefined" === typeof m.enabled || m.enabled) && !k.isNull && !1 !== k.visible) {
                            var r = A(m.symbol, this.symbol);
                            var t = this.markerAttribs(k, k.selected && "select");
                            this.enabledDataSorting &&
                                (k.startXPos = h.reversed ? -t.width : h.width);
                            var B = !1 !== k.isInside;
                            a ? a[B ? "show" : "hide"](B).animate(t) : B && (0 < t.width || k.hasImage) && (k.graphic = a = c.renderer.symbol(r, t.x, t.y, t.width, t.height, p ? m : d).add(g), this.enabledDataSorting && c.hasRendered && (a.attr({
                                x: k.startXPos
                            }), l = "animate"));
                            a && "animate" === l && a[B ? "show" : "hide"](B).animate(t);
                            if (a && !c.styledMode) a[l](this.pointAttribs(k, k.selected && "select"));
                            a && a.addClass(k.getClassName(), !0)
                        } else a && (k.graphic = a.destroy())
                    }
            },
            markerAttribs: function (e, c) {
                var b = this.options,
                    a = b.marker,
                    d = e.marker || {},
                    g = d.symbol || a.symbol,
                    h = A(d.radius, a.radius);
                c && (a = a.states[c], c = d.states && d.states[c], h = A(c && c.radius, a && a.radius, h + (a && a.radiusPlus || 0)));
                e.hasImage = g && 0 === g.indexOf("url");
                e.hasImage && (h = 0);
                e = {
                    x: b.crisp ? Math.floor(e.plotX) - h : e.plotX - h,
                    y: e.plotY - h
                };
                h && (e.width = e.height = 2 * h);
                return e
            },
            pointAttribs: function (e, c) {
                var b = this.options.marker,
                    a = e && e.options,
                    d = a && a.marker || {},
                    g = this.color,
                    h = a && a.color,
                    f = e && e.color;
                a = A(d.lineWidth, b.lineWidth);
                var k = e && e.zone && e.zone.color;
                e = 1;
                g =
                    h || k || f || g;
                h = d.fillColor || b.fillColor || g;
                g = d.lineColor || b.lineColor || g;
                c = c || "normal";
                b = b.states[c];
                c = d.states && d.states[c] || {};
                a = A(c.lineWidth, b.lineWidth, a + A(c.lineWidthPlus, b.lineWidthPlus, 0));
                h = c.fillColor || b.fillColor || h;
                g = c.lineColor || b.lineColor || g;
                e = A(c.opacity, b.opacity, e);
                return {
                    stroke: g,
                    "stroke-width": a,
                    fill: h,
                    opacity: e
                }
            },
            destroy: function (e) {
                var c = this,
                    b = c.chart,
                    a = /AppleWebKit\/533/.test(F.navigator.userAgent),
                    d, g, h = c.data || [],
                    f, k;
                m(c, "destroy");
                this.removeEvents(e);
                (c.axisTypes || []).forEach(function (b) {
                    (k =
                        c[b]) && k.series && (p(k.series, c), k.isDirty = k.forceRedraw = !0)
                });
                c.legendItem && c.chart.legend.destroyItem(c);
                for (g = h.length; g--;)(f = h[g]) && f.destroy && f.destroy();
                c.points = null;
                G.clearTimeout(c.animationTimeout);
                r(c, function (b, c) {
                    b instanceof D && !b.survive && (d = a && "group" === c ? "hide" : "destroy", b[d]())
                });
                b.hoverSeries === c && (b.hoverSeries = null);
                p(b.series, c);
                b.orderSeries();
                r(c, function (b, a) {
                    e && "hcEvents" === a || delete c[a]
                })
            },
            getGraphPath: function (e, c, b) {
                var a = this,
                    d = a.options,
                    g = d.step,
                    h, f = [],
                    k = [],
                    l;
                e = e ||
                    a.points;
                (h = e.reversed) && e.reverse();
                (g = {
                    right: 1,
                    center: 2
                } [g] || g && 3) && h && (g = 4 - g);
                e = this.getValidPoints(e, !1, !(d.connectNulls && !c && !b));
                e.forEach(function (h, m) {
                    var p = h.plotX,
                        r = h.plotY,
                        t = e[m - 1];
                    (h.leftCliff || t && t.rightCliff) && !b && (l = !0);
                    h.isNull && !E(c) && 0 < m ? l = !d.connectNulls : h.isNull && !c ? l = !0 : (0 === m || l ? m = [
                        ["M", h.plotX, h.plotY]
                    ] : a.getPointSpline ? m = [a.getPointSpline(e, h, m)] : g ? (m = 1 === g ? [
                        ["L", t.plotX, r]
                    ] : 2 === g ? [
                        ["L", (t.plotX + p) / 2, t.plotY],
                        ["L", (t.plotX + p) / 2, r]
                    ] : [
                        ["L", p, t.plotY]
                    ], m.push(["L", p, r])) : m = [
                        ["L",
                            p, r
                        ]
                    ], k.push(h.x), g && (k.push(h.x), 2 === g && k.push(h.x)), f.push.apply(f, m), l = !1)
                });
                f.xMap = k;
                return a.graphPath = f
            },
            drawGraph: function () {
                var e = this,
                    c = this.options,
                    b = (this.gappedPath || this.getGraphPath).call(this),
                    a = this.chart.styledMode,
                    d = [
                        ["graph", "highcharts-graph"]
                    ];
                a || d[0].push(c.lineColor || this.color || "#cccccc", c.dashStyle);
                d = e.getZonesGraphs(d);
                d.forEach(function (d, g) {
                    var h = d[0],
                        f = e[h],
                        k = f ? "animate" : "attr";
                    f ? (f.endX = e.preventGraphAnimation ? null : b.xMap, f.animate({
                        d: b
                    })) : b.length && (e[h] = f = e.chart.renderer.path(b).addClass(d[1]).attr({
                        zIndex: 1
                    }).add(e.group));
                    f && !a && (h = {
                        stroke: d[2],
                        "stroke-width": c.lineWidth,
                        fill: e.fillGraph && e.color || "none"
                    }, d[3] ? h.dashstyle = d[3] : "square" !== c.linecap && (h["stroke-linecap"] = h["stroke-linejoin"] = "round"), f[k](h).shadow(2 > g && c.shadow));
                    f && (f.startX = b.xMap, f.isArea = b.isArea)
                })
            },
            getZonesGraphs: function (a) {
                this.zones.forEach(function (c, b) {
                    b = ["zone-graph-" + b, "highcharts-graph highcharts-zone-graph-" + b + " " + (c.className || "")];
                    this.chart.styledMode || b.push(c.color || this.color, c.dashStyle || this.options.dashStyle);
                    a.push(b)
                }, this);
                return a
            },
            applyZones: function () {
                var a = this,
                    c = this.chart,
                    b = c.renderer,
                    d = this.zones,
                    g, h, f = this.clips || [],
                    k, l = this.graph,
                    m = this.area,
                    p = Math.max(c.chartWidth, c.chartHeight),
                    r = this[(this.zoneAxis || "y") + "Axis"],
                    t = c.inverted,
                    B, n, x, F = !1,
                    u, M;
                if (d.length && (l || m) && r && "undefined" !== typeof r.min) {
                    var v = r.reversed;
                    var I = r.horiz;
                    l && !this.showLine && l.hide();
                    m && m.hide();
                    var E = r.getExtremes();
                    d.forEach(function (e, d) {
                        g = v ? I ? c.plotWidth : 0 : I ? 0 : r.toPixels(E.min) || 0;
                        g = q(A(h, g), 0, p);
                        h = q(Math.round(r.toPixels(A(e.value, E.max),
                            !0) || 0), 0, p);
                        F && (g = h = r.toPixels(E.max));
                        B = Math.abs(g - h);
                        n = Math.min(g, h);
                        x = Math.max(g, h);
                        r.isXAxis ? (k = {
                            x: t ? x : n,
                            y: 0,
                            width: B,
                            height: p
                        }, I || (k.x = c.plotHeight - k.x)) : (k = {
                            x: 0,
                            y: t ? x : n,
                            width: p,
                            height: B
                        }, I && (k.y = c.plotWidth - k.y));
                        t && b.isVML && (k = r.isXAxis ? {
                            x: 0,
                            y: v ? n : x,
                            height: k.width,
                            width: c.chartWidth
                        } : {
                            x: k.y - c.plotLeft - c.spacingBox.x,
                            y: 0,
                            width: k.height,
                            height: c.chartHeight
                        });
                        f[d] ? f[d].animate(k) : f[d] = b.clipRect(k);
                        u = a["zone-area-" + d];
                        M = a["zone-graph-" + d];
                        l && M && M.clip(f[d]);
                        m && u && u.clip(f[d]);
                        F = e.value > E.max;
                        a.resetZones && 0 === h && (h = void 0)
                    });
                    this.clips = f
                } else a.visible && (l && l.show(!0), m && m.show(!0))
            },
            invertGroups: function (a) {
                function c() {
                    ["group", "markerGroup"].forEach(function (c) {
                        b[c] && (e.renderer.isVML && b[c].attr({
                            width: b.yAxis.len,
                            height: b.xAxis.len
                        }), b[c].width = b.yAxis.len, b[c].height = b.xAxis.len, b[c].invert(b.isRadialSeries ? !1 : a))
                    })
                }
                var b = this,
                    e = b.chart;
                b.xAxis && (b.eventsToUnbind.push(J(e, "resize", c)), c(), b.invertGroups = c)
            },
            plotGroup: function (a, c, b, d, g) {
                var e = this[a],
                    h = !e;
                b = {
                    visibility: b,
                    zIndex: d ||
                        .1
                };
                "undefined" === typeof this.opacity || this.chart.styledMode || "inactive" === this.state || (b.opacity = this.opacity);
                h && (this[a] = e = this.chart.renderer.g().add(g));
                e.addClass("highcharts-" + c + " highcharts-series-" + this.index + " highcharts-" + this.type + "-series " + (E(this.colorIndex) ? "highcharts-color-" + this.colorIndex + " " : "") + (this.options.className || "") + (e.hasClass("highcharts-tracker") ? " highcharts-tracker" : ""), !0);
                e.attr(b)[h ? "attr" : "animate"](this.getPlotBox());
                return e
            },
            getPlotBox: function () {
                var a = this.chart,
                    c = this.xAxis,
                    b = this.yAxis;
                a.inverted && (c = b, b = this.xAxis);
                return {
                    translateX: c ? c.left : a.plotLeft,
                    translateY: b ? b.top : a.plotTop,
                    scaleX: 1,
                    scaleY: 1
                }
            },
            removeEvents: function (a) {
                a ? this.eventsToUnbind.length && (this.eventsToUnbind.forEach(function (c) {
                    c()
                }), this.eventsToUnbind.length = 0) : N(this)
            },
            render: function () {
                var a = this,
                    c = a.chart,
                    b = a.options,
                    d = H(b.animation),
                    g = !a.finishedAnimating && c.renderer.isSVG && d.duration,
                    h = a.visible ? "inherit" : "hidden",
                    f = b.zIndex,
                    k = a.hasRendered,
                    l = c.seriesGroup,
                    p = c.inverted;
                m(this, "render");
                var r = a.plotGroup("group", "series", h, f, l);
                a.markerGroup = a.plotGroup("markerGroup", "markers", h, f, l);
                g && a.animate && a.animate(!0);
                r.inverted = a.isCartesian || a.invertable ? p : !1;
                a.drawGraph && (a.drawGraph(), a.applyZones());
                a.visible && a.drawPoints();
                a.drawDataLabels && a.drawDataLabels();
                a.redrawPoints && a.redrawPoints();
                a.drawTracker && !1 !== a.options.enableMouseTracking && a.drawTracker();
                a.invertGroups(p);
                !1 === b.clip || a.sharedClipKey || k || r.clip(c.clipRect);
                g && a.animate && a.animate();
                k || (g && d.defer && (g += d.defer),
                    a.animationTimeout = M(function () {
                        a.afterAnimate()
                    }, g || 0));
                a.isDirty = !1;
                a.hasRendered = !0;
                m(a, "afterRender")
            },
            redraw: function () {
                var a = this.chart,
                    c = this.isDirty || this.isDirtyData,
                    b = this.group,
                    d = this.xAxis,
                    g = this.yAxis;
                b && (a.inverted && b.attr({
                    width: a.plotWidth,
                    height: a.plotHeight
                }), b.animate({
                    translateX: A(d && d.left, a.plotLeft),
                    translateY: A(g && g.top, a.plotTop)
                }));
                this.translate();
                this.render();
                c && delete this.kdTree
            },
            kdAxisArray: ["clientX", "plotY"],
            searchPoint: function (a, c) {
                var b = this.xAxis,
                    d = this.yAxis,
                    e = this.chart.inverted;
                return this.searchKDTree({
                    clientX: e ? b.len - a.chartY + b.pos : a.chartX - b.pos,
                    plotY: e ? d.len - a.chartX + d.pos : a.chartY - d.pos
                }, c, a)
            },
            buildKDTree: function (a) {
                function c(a, d, e) {
                    var g;
                    if (g = a && a.length) {
                        var h = b.kdAxisArray[d % e];
                        a.sort(function (b, c) {
                            return b[h] - c[h]
                        });
                        g = Math.floor(g / 2);
                        return {
                            point: a[g],
                            left: c(a.slice(0, g), d + 1, e),
                            right: c(a.slice(g + 1), d + 1, e)
                        }
                    }
                }
                this.buildingKdTree = !0;
                var b = this,
                    d = -1 < b.options.findNearestPointBy.indexOf("y") ? 2 : 1;
                delete b.kdTree;
                M(function () {
                    b.kdTree = c(b.getValidPoints(null,
                        !b.directTouch), d, d);
                    b.buildingKdTree = !1
                }, b.options.kdNow || a && "touchstart" === a.type ? 0 : 1)
            },
            searchKDTree: function (a, c, b) {
                function d(b, c, a, k) {
                    var l = c.point,
                        m = e.kdAxisArray[a % k],
                        p = l;
                    var r = E(b[g]) && E(l[g]) ? Math.pow(b[g] - l[g], 2) : null;
                    var t = E(b[h]) && E(l[h]) ? Math.pow(b[h] - l[h], 2) : null;
                    t = (r || 0) + (t || 0);
                    l.dist = E(t) ? Math.sqrt(t) : Number.MAX_VALUE;
                    l.distX = E(r) ? Math.sqrt(r) : Number.MAX_VALUE;
                    m = b[m] - l[m];
                    t = 0 > m ? "left" : "right";
                    r = 0 > m ? "right" : "left";
                    c[t] && (t = d(b, c[t], a + 1, k), p = t[f] < p[f] ? t : l);
                    c[r] && Math.sqrt(m * m) < p[f] &&
                        (b = d(b, c[r], a + 1, k), p = b[f] < p[f] ? b : p);
                    return p
                }
                var e = this,
                    g = this.kdAxisArray[0],
                    h = this.kdAxisArray[1],
                    f = c ? "distX" : "dist";
                c = -1 < e.options.findNearestPointBy.indexOf("y") ? 2 : 1;
                this.kdTree || this.buildingKdTree || this.buildKDTree(b);
                if (this.kdTree) return d(a, this.kdTree, c, c)
            },
            pointPlacementToXValue: function () {
                var a = this.options,
                    c = a.pointRange,
                    b = this.xAxis;
                a = a.pointPlacement;
                "between" === a && (a = b.reversed ? -.5 : .5);
                return g(a) ? a * A(c, b.pointRange) : 0
            },
            isPointInside: function (a) {
                return "undefined" !== typeof a.plotY &&
                    "undefined" !== typeof a.plotX && 0 <= a.plotY && a.plotY <= this.yAxis.len && 0 <= a.plotX && a.plotX <= this.xAxis.len
            }
        });
        ""
    });
    O(n, "Extensions/Stacking.js", [n["Core/Axis/Axis.js"], n["Core/Chart/Chart.js"], n["Core/Globals.js"], n["Core/Axis/StackingAxis.js"], n["Core/Utilities.js"]], function (f, a, n, y, D) {
        var G = D.correctFloat,
            C = D.defined,
            J = D.destroyObjectProperties,
            H = D.format,
            v = D.isNumber,
            L = D.pick;
        "";
        var q = n.Series,
            K = function () {
                function a(a, f, n, q, m) {
                    var h = a.chart.inverted;
                    this.axis = a;
                    this.isNegative = n;
                    this.options = f = f || {};
                    this.x = q;
                    this.total = null;
                    this.points = {};
                    this.hasValidPoints = !1;
                    this.stack = m;
                    this.rightCliff = this.leftCliff = 0;
                    this.alignOptions = {
                        align: f.align || (h ? n ? "left" : "right" : "center"),
                        verticalAlign: f.verticalAlign || (h ? "middle" : n ? "bottom" : "top"),
                        y: f.y,
                        x: f.x
                    };
                    this.textAlign = f.textAlign || (h ? n ? "right" : "left" : "center")
                }
                a.prototype.destroy = function () {
                    J(this, this.axis)
                };
                a.prototype.render = function (a) {
                    var f = this.axis.chart,
                        p = this.options,
                        n = p.format;
                    n = n ? H(n, this, f) : p.formatter.call(this);
                    this.label ? this.label.attr({
                        text: n,
                        visibility: "hidden"
                    }) : (this.label = f.renderer.label(n, null, null, p.shape, null, null, p.useHTML, !1, "stack-labels"), n = {
                        r: p.borderRadius || 0,
                        text: n,
                        rotation: p.rotation,
                        padding: L(p.padding, 5),
                        visibility: "hidden"
                    }, f.styledMode || (n.fill = p.backgroundColor, n.stroke = p.borderColor, n["stroke-width"] = p.borderWidth, this.label.css(p.style)), this.label.attr(n), this.label.added || this.label.add(a));
                    this.label.labelrank = f.plotHeight
                };
                a.prototype.setOffset = function (a, f, n, u, m) {
                    var h = this.axis,
                        l = h.chart;
                    u = h.translate(h.stacking.usePercentage ?
                        100 : u ? u : this.total, 0, 0, 0, 1);
                    n = h.translate(n ? n : 0);
                    n = C(u) && Math.abs(u - n);
                    a = L(m, l.xAxis[0].translate(this.x)) + a;
                    h = C(u) && this.getStackBox(l, this, a, u, f, n, h);
                    f = this.label;
                    n = this.isNegative;
                    a = "justify" === L(this.options.overflow, "justify");
                    var k = this.textAlign;
                    f && h && (m = f.getBBox(), u = f.padding, k = "left" === k ? l.inverted ? -u : u : "right" === k ? m.width : l.inverted && "center" === k ? m.width / 2 : l.inverted ? n ? m.width + u : -u : m.width / 2, n = l.inverted ? m.height / 2 : n ? -u : m.height, this.alignOptions.x = L(this.options.x, 0), this.alignOptions.y =
                        L(this.options.y, 0), h.x -= k, h.y -= n, f.align(this.alignOptions, null, h), l.isInsidePlot(f.alignAttr.x + k - this.alignOptions.x, f.alignAttr.y + n - this.alignOptions.y) ? f.show() : (f.alignAttr.y = -9999, a = !1), a && q.prototype.justifyDataLabel.call(this.axis, f, this.alignOptions, f.alignAttr, m, h), f.attr({
                            x: f.alignAttr.x,
                            y: f.alignAttr.y
                        }), L(!a && this.options.crop, !0) && ((l = v(f.x) && v(f.y) && l.isInsidePlot(f.x - u + f.width, f.y) && l.isInsidePlot(f.x + u, f.y)) || f.hide()))
                };
                a.prototype.getStackBox = function (a, f, n, q, m, h, l) {
                    var k = f.axis.reversed,
                        g = a.inverted,
                        d = l.height + l.pos - (g ? a.plotLeft : a.plotTop);
                    f = f.isNegative && !k || !f.isNegative && k;
                    return {
                        x: g ? f ? q - l.right : q - h + l.pos - a.plotLeft : n + a.xAxis[0].transB - a.plotLeft,
                        y: g ? l.height - n - m : f ? d - q - h : d - q,
                        width: g ? h : m,
                        height: g ? m : h
                    }
                };
                return a
            }();
        a.prototype.getStacks = function () {
            var a = this,
                f = a.inverted;
            a.yAxis.forEach(function (a) {
                a.stacking && a.stacking.stacks && a.hasVisibleSeries && (a.stacking.oldStacks = a.stacking.stacks)
            });
            a.series.forEach(function (p) {
                var n = p.xAxis && p.xAxis.options || {};
                !p.options.stacking || !0 !==
                    p.visible && !1 !== a.options.chart.ignoreHiddenSeries || (p.stackKey = [p.type, L(p.options.stack, ""), f ? n.top : n.left, f ? n.height : n.width].join())
            })
        };
        y.compose(f);
        q.prototype.setGroupedPoints = function () {
            this.options.centerInCategory && (this.is("column") || this.is("columnrange")) && !this.options.stacking && 1 < this.chart.series.length && q.prototype.setStackedPoints.call(this, "group")
        };
        q.prototype.setStackedPoints = function (a) {
            var f = a || this.options.stacking;
            if (f && (!0 === this.visible || !1 === this.chart.options.chart.ignoreHiddenSeries)) {
                var n =
                    this.processedXData,
                    q = this.processedYData,
                    u = [],
                    m = q.length,
                    h = this.options,
                    l = h.threshold,
                    k = L(h.startFromThreshold && l, 0);
                h = h.stack;
                a = a ? this.type + "," + f : this.stackKey;
                var g = "-" + a,
                    d = this.negStacks,
                    x = this.yAxis,
                    r = x.stacking.stacks,
                    A = x.stacking.oldStacks,
                    v, B;
                x.stacking.stacksTouched += 1;
                for (B = 0; B < m; B++) {
                    var M = n[B];
                    var E = q[B];
                    var F = this.getStackIndicator(F, M, this.index);
                    var e = F.key;
                    var c = (v = d && E < (k ? 0 : l)) ? g : a;
                    r[c] || (r[c] = {});
                    r[c][M] || (A[c] && A[c][M] ? (r[c][M] = A[c][M], r[c][M].total = null) : r[c][M] = new K(x, x.options.stackLabels,
                        v, M, h));
                    c = r[c][M];
                    null !== E ? (c.points[e] = c.points[this.index] = [L(c.cumulative, k)], C(c.cumulative) || (c.base = e), c.touched = x.stacking.stacksTouched, 0 < F.index && !1 === this.singleStacks && (c.points[e][0] = c.points[this.index + "," + M + ",0"][0])) : c.points[e] = c.points[this.index] = null;
                    "percent" === f ? (v = v ? a : g, d && r[v] && r[v][M] ? (v = r[v][M], c.total = v.total = Math.max(v.total, c.total) + Math.abs(E) || 0) : c.total = G(c.total + (Math.abs(E) || 0))) : "group" === f ? null !== E && (c.total = (c.total || 0) + 1) : c.total = G(c.total + (E || 0));
                    c.cumulative =
                        "group" === f ? (c.total || 1) - 1 : L(c.cumulative, k) + (E || 0);
                    null !== E && (c.points[e].push(c.cumulative), u[B] = c.cumulative, c.hasValidPoints = !0)
                }
                "percent" === f && (x.stacking.usePercentage = !0);
                "group" !== f && (this.stackedYData = u);
                x.stacking.oldStacks = {}
            }
        };
        q.prototype.modifyStacks = function () {
            var a = this,
                f = a.stackKey,
                n = a.yAxis.stacking.stacks,
                q = a.processedXData,
                v, m = a.options.stacking;
            a[m + "Stacker"] && [f, "-" + f].forEach(function (h) {
                for (var f = q.length, k, g; f--;)
                    if (k = q[f], v = a.getStackIndicator(v, k, a.index, h), g = (k = n[h] && n[h][k]) &&
                        k.points[v.key]) a[m + "Stacker"](g, k, f)
            })
        };
        q.prototype.percentStacker = function (a, f, n) {
            f = f.total ? 100 / f.total : 0;
            a[0] = G(a[0] * f);
            a[1] = G(a[1] * f);
            this.stackedYData[n] = a[1]
        };
        q.prototype.getStackIndicator = function (a, f, n, q) {
            !C(a) || a.x !== f || q && a.key !== q ? a = {
                x: f,
                index: 0,
                key: q
            } : a.index++;
            a.key = [n, f, a.index].join();
            return a
        };
        n.StackItem = K;
        return n.StackItem
    });
    O(n, "Core/Dynamics.js", [n["Core/Axis/Axis.js"], n["Core/Chart/Chart.js"], n["Core/Globals.js"], n["Core/Options.js"], n["Core/Series/Point.js"], n["Core/Time.js"],
        n["Core/Utilities.js"]
    ], function (f, a, n, y, D, G, C) {
        var J = y.time,
            H = C.addEvent,
            v = C.animate,
            L = C.createElement,
            q = C.css,
            K = C.defined,
            E = C.erase,
            p = C.error,
            t = C.extend,
            I = C.fireEvent,
            u = C.isArray,
            m = C.isNumber,
            h = C.isObject,
            l = C.isString,
            k = C.merge,
            g = C.objectEach,
            d = C.pick,
            x = C.relativeLength,
            r = C.setAnimation,
            A = C.splat;
        y = n.Series;
        var N = n.seriesTypes;
        n.cleanRecursively = function (a, d) {
            var f = {};
            g(a, function (g, e) {
                if (h(a[e], !0) && !a.nodeType && d[e]) g = n.cleanRecursively(a[e], d[e]), Object.keys(g).length && (f[e] = g);
                else if (h(a[e]) ||
                    a[e] !== d[e]) f[e] = a[e]
            });
            return f
        };
        t(a.prototype, {
            addSeries: function (a, g, h) {
                var f, e = this;
                a && (g = d(g, !0), I(e, "addSeries", {
                    options: a
                }, function () {
                    f = e.initSeries(a);
                    e.isDirtyLegend = !0;
                    e.linkSeries();
                    f.enabledDataSorting && f.setData(a.data, !1);
                    I(e, "afterAddSeries", {
                        series: f
                    });
                    g && e.redraw(h)
                }));
                return f
            },
            addAxis: function (a, d, g, h) {
                return this.createAxis(d ? "xAxis" : "yAxis", {
                    axis: a,
                    redraw: g,
                    animation: h
                })
            },
            addColorAxis: function (a, d, g) {
                return this.createAxis("colorAxis", {
                    axis: a,
                    redraw: d,
                    animation: g
                })
            },
            createAxis: function (a,
                g) {
                var h = this.options,
                    l = "colorAxis" === a,
                    e = g.redraw,
                    c = g.animation;
                g = k(g.axis, {
                    index: this[a].length,
                    isX: "xAxis" === a
                });
                var b = l ? new n.ColorAxis(this, g) : new f(this, g);
                h[a] = A(h[a] || {});
                h[a].push(g);
                l && (this.isDirtyLegend = !0, this.axes.forEach(function (b) {
                    b.series = []
                }), this.series.forEach(function (b) {
                    b.bindAxes();
                    b.isDirtyData = !0
                }));
                d(e, !0) && this.redraw(c);
                return b
            },
            showLoading: function (a) {
                var g = this,
                    h = g.options,
                    f = g.loadingDiv,
                    e = h.loading,
                    c = function () {
                        f && q(f, {
                            left: g.plotLeft + "px",
                            top: g.plotTop + "px",
                            width: g.plotWidth +
                                "px",
                            height: g.plotHeight + "px"
                        })
                    };
                f || (g.loadingDiv = f = L("div", {
                    className: "highcharts-loading highcharts-loading-hidden"
                }, null, g.container), g.loadingSpan = L("span", {
                    className: "highcharts-loading-inner"
                }, null, f), H(g, "redraw", c));
                f.className = "highcharts-loading";
                g.loadingSpan.innerHTML = d(a, h.lang.loading, "");
                g.styledMode || (q(f, t(e.style, {
                    zIndex: 10
                })), q(g.loadingSpan, e.labelStyle), g.loadingShown || (q(f, {
                    opacity: 0,
                    display: ""
                }), v(f, {
                    opacity: e.style.opacity || .5
                }, {
                    duration: e.showDuration || 0
                })));
                g.loadingShown = !0;
                c()
            },
            hideLoading: function () {
                var a = this.options,
                    d = this.loadingDiv;
                d && (d.className = "highcharts-loading highcharts-loading-hidden", this.styledMode || v(d, {
                    opacity: 0
                }, {
                    duration: a.loading.hideDuration || 100,
                    complete: function () {
                        q(d, {
                            display: "none"
                        })
                    }
                }));
                this.loadingShown = !1
            },
            propsRequireDirtyBox: "backgroundColor borderColor borderWidth borderRadius plotBackgroundColor plotBackgroundImage plotBorderColor plotBorderWidth plotShadow shadow".split(" "),
            propsRequireReflow: "margin marginTop marginRight marginBottom marginLeft spacing spacingTop spacingRight spacingBottom spacingLeft".split(" "),
            propsRequireUpdateSeries: "chart.inverted chart.polar chart.ignoreHiddenSeries chart.type colors plotOptions time tooltip".split(" "),
            collectionsWithUpdate: ["xAxis", "yAxis", "zAxis", "series"],
            update: function (a, h, f, p) {
                var e = this,
                    c = {
                        credits: "addCredits",
                        title: "setTitle",
                        subtitle: "setSubtitle",
                        caption: "setCaption"
                    },
                    b, r, q, t = a.isResponsiveOptions,
                    B = [];
                I(e, "update", {
                    options: a
                });
                t || e.setResponsive(!1, !0);
                a = n.cleanRecursively(a, e.options);
                k(!0, e.userOptions, a);
                if (b = a.chart) {
                    k(!0, e.options.chart, b);
                    "className" in
                    b && e.setClassName(b.className);
                    "reflow" in b && e.setReflow(b.reflow);
                    if ("inverted" in b || "polar" in b || "type" in b) {
                        e.propFromSeries();
                        var F = !0
                    }
                    "alignTicks" in b && (F = !0);
                    g(b, function (b, a) {
                        -1 !== e.propsRequireUpdateSeries.indexOf("chart." + a) && (r = !0); - 1 !== e.propsRequireDirtyBox.indexOf(a) && (e.isDirtyBox = !0); - 1 !== e.propsRequireReflow.indexOf(a) && (t ? e.isDirtyBox = !0 : q = !0)
                    });
                    !e.styledMode && "style" in b && e.renderer.setStyle(b.style)
                }!e.styledMode && a.colors && (this.options.colors = a.colors);
                a.plotOptions && k(!0, this.options.plotOptions,
                    a.plotOptions);
                a.time && this.time === J && (this.time = new G(a.time));
                g(a, function (b, a) {
                    if (e[a] && "function" === typeof e[a].update) e[a].update(b, !1);
                    else if ("function" === typeof e[c[a]]) e[c[a]](b);
                    "chart" !== a && -1 !== e.propsRequireUpdateSeries.indexOf(a) && (r = !0)
                });
                this.collectionsWithUpdate.forEach(function (b) {
                    if (a[b]) {
                        if ("series" === b) {
                            var c = [];
                            e[b].forEach(function (b, a) {
                                b.options.isInternal || c.push(d(b.options.index, a))
                            })
                        }
                        A(a[b]).forEach(function (a, d) {
                            var g = K(a.id),
                                h;
                            g && (h = e.get(a.id));
                            h || (h = e[b][c ? c[d] : d]) &&
                                g && K(h.options.id) && (h = void 0);
                            h && h.coll === b && (h.update(a, !1), f && (h.touched = !0));
                            !h && f && e.collectionsWithInit[b] && (e.collectionsWithInit[b][0].apply(e, [a].concat(e.collectionsWithInit[b][1] || []).concat([!1])).touched = !0)
                        });
                        f && e[b].forEach(function (b) {
                            b.touched || b.options.isInternal ? delete b.touched : B.push(b)
                        })
                    }
                });
                B.forEach(function (b) {
                    b.remove && b.remove(!1)
                });
                F && e.axes.forEach(function (b) {
                    b.update({}, !1)
                });
                r && e.getSeriesOrderByLinks().forEach(function (b) {
                    b.chart && b.update({}, !1)
                }, this);
                a.loading &&
                    k(!0, e.options.loading, a.loading);
                F = b && b.width;
                b = b && b.height;
                l(b) && (b = x(b, F || e.chartWidth));
                q || m(F) && F !== e.chartWidth || m(b) && b !== e.chartHeight ? e.setSize(F, b, p) : d(h, !0) && e.redraw(p);
                I(e, "afterUpdate", {
                    options: a,
                    redraw: h,
                    animation: p
                })
            },
            setSubtitle: function (a, d) {
                this.applyDescription("subtitle", a);
                this.layOutTitles(d)
            },
            setCaption: function (a, d) {
                this.applyDescription("caption", a);
                this.layOutTitles(d)
            }
        });
        a.prototype.collectionsWithInit = {
            xAxis: [a.prototype.addAxis, [!0]],
            yAxis: [a.prototype.addAxis, [!1]],
            series: [a.prototype.addSeries]
        };
        t(D.prototype, {
            update: function (a, g, f, k) {
                function e() {
                    c.applyOptions(a);
                    var e = l && c.hasDummyGraphic;
                    e = null === c.y ? !e : e;
                    l && e && (c.graphic = l.destroy(), delete c.hasDummyGraphic);
                    h(a, !0) && (l && l.element && a && a.marker && "undefined" !== typeof a.marker.symbol && (c.graphic = l.destroy()), a && a.dataLabels && c.dataLabel && (c.dataLabel = c.dataLabel.destroy()), c.connector && (c.connector = c.connector.destroy()));
                    m = c.index;
                    b.updateParallelArrays(c, m);
                    r.data[m] = h(r.data[m], !0) || h(a, !0) ? c.options :
                        d(a, r.data[m]);
                    b.isDirty = b.isDirtyData = !0;
                    !b.fixedBox && b.hasCartesianSeries && (p.isDirtyBox = !0);
                    "point" === r.legendType && (p.isDirtyLegend = !0);
                    g && p.redraw(f)
                }
                var c = this,
                    b = c.series,
                    l = c.graphic,
                    m, p = b.chart,
                    r = b.options;
                g = d(g, !0);
                !1 === k ? e() : c.firePointEvent("update", {
                    options: a
                }, e)
            },
            remove: function (a, d) {
                this.series.removePoint(this.series.data.indexOf(this), a, d)
            }
        });
        t(y.prototype, {
            addPoint: function (a, g, h, f, e) {
                var c = this.options,
                    b = this.data,
                    k = this.chart,
                    l = this.xAxis;
                l = l && l.hasNames && l.names;
                var m = c.data,
                    p =
                    this.xData,
                    r;
                g = d(g, !0);
                var n = {
                    series: this
                };
                this.pointClass.prototype.applyOptions.apply(n, [a]);
                var q = n.x;
                var t = p.length;
                if (this.requireSorting && q < p[t - 1])
                    for (r = !0; t && p[t - 1] > q;) t--;
                this.updateParallelArrays(n, "splice", t, 0, 0);
                this.updateParallelArrays(n, t);
                l && n.name && (l[q] = n.name);
                m.splice(t, 0, a);
                r && (this.data.splice(t, 0, null), this.processData());
                "point" === c.legendType && this.generatePoints();
                h && (b[0] && b[0].remove ? b[0].remove(!1) : (b.shift(), this.updateParallelArrays(n, "shift"), m.shift()));
                !1 !== e && I(this,
                    "addPoint", {
                        point: n
                    });
                this.isDirtyData = this.isDirty = !0;
                g && k.redraw(f)
            },
            removePoint: function (a, g, h) {
                var f = this,
                    e = f.data,
                    c = e[a],
                    b = f.points,
                    k = f.chart,
                    l = function () {
                        b && b.length === e.length && b.splice(a, 1);
                        e.splice(a, 1);
                        f.options.data.splice(a, 1);
                        f.updateParallelArrays(c || {
                            series: f
                        }, "splice", a, 1);
                        c && c.destroy();
                        f.isDirty = !0;
                        f.isDirtyData = !0;
                        g && k.redraw()
                    };
                r(h, k);
                g = d(g, !0);
                c ? c.firePointEvent("remove", null, l) : l()
            },
            remove: function (a, g, h, f) {
                function e() {
                    c.destroy(f);
                    c.remove = null;
                    b.isDirtyLegend = b.isDirtyBox = !0;
                    b.linkSeries();
                    d(a, !0) && b.redraw(g)
                }
                var c = this,
                    b = c.chart;
                !1 !== h ? I(c, "remove", null, e) : e()
            },
            update: function (a, g) {
                a = n.cleanRecursively(a, this.userOptions);
                I(this, "update", {
                    options: a
                });
                var h = this,
                    f = h.chart,
                    e = h.userOptions,
                    c = h.initialType || h.type,
                    b = a.type || e.type || f.options.chart.type,
                    l = !(this.hasDerivedData || a.dataGrouping || b && b !== this.type || "undefined" !== typeof a.pointStart || a.pointInterval || a.pointIntervalUnit || a.keys),
                    m = N[c].prototype,
                    r, q = ["eventOptions", "navigatorSeries", "baseSeries"],
                    x = h.finishedAnimating && {
                        animation: !1
                    },
                    B = {};
                l && (q.push("data", "isDirtyData", "points", "processedXData", "processedYData", "xIncrement", "cropped", "_hasPointMarkers", "_hasPointLabels", "mapMap", "mapData", "minY", "maxY", "minX", "maxX"), !1 !== a.visible && q.push("area", "graph"), h.parallelArrays.forEach(function (b) {
                    q.push(b + "Data")
                }), a.data && (a.dataSorting && t(h.options.dataSorting, a.dataSorting), this.setData(a.data, !1)));
                a = k(e, x, {
                        index: "undefined" === typeof e.index ? h.index : e.index,
                        pointStart: d(e.pointStart, h.xData[0])
                    }, !l && {
                        data: h.options.data
                    },
                    a);
                l && a.data && (a.data = h.options.data);
                q = ["group", "markerGroup", "dataLabelsGroup", "transformGroup"].concat(q);
                q.forEach(function (b) {
                    q[b] = h[b];
                    delete h[b]
                });
                h.remove(!1, null, !1, !0);
                for (r in m) h[r] = void 0;
                N[b || c] ? t(h, N[b || c].prototype) : p(17, !0, f, {
                    missingModuleFor: b || c
                });
                q.forEach(function (b) {
                    h[b] = q[b]
                });
                h.init(f, a);
                if (l && this.points) {
                    var A = h.options;
                    !1 === A.visible ? (B.graphic = 1, B.dataLabel = 1) : h._hasPointLabels || (a = A.marker, e = A.dataLabels, a && (!1 === a.enabled || "symbol" in a) && (B.graphic = 1), e && !1 === e.enabled &&
                        (B.dataLabel = 1));
                    this.points.forEach(function (b) {
                        b && b.series && (b.resolveColor(), Object.keys(B).length && b.destroyElements(B), !1 === A.showInLegend && b.legendItem && f.legend.destroyItem(b))
                    }, this)
                }
                h.initialType = c;
                f.linkSeries();
                I(this, "afterUpdate");
                d(g, !0) && f.redraw(l ? void 0 : !1)
            },
            setName: function (a) {
                this.name = this.options.name = this.userOptions.name = a;
                this.chart.isDirtyLegend = !0
            }
        });
        t(f.prototype, {
            update: function (a, h) {
                var f = this.chart,
                    l = a && a.events || {};
                a = k(this.userOptions, a);
                f.options[this.coll].indexOf &&
                    (f.options[this.coll][f.options[this.coll].indexOf(this.userOptions)] = a);
                g(f.options[this.coll].events, function (a, c) {
                    "undefined" === typeof l[c] && (l[c] = void 0)
                });
                this.destroy(!0);
                this.init(f, t(a, {
                    events: l
                }));
                f.isDirtyBox = !0;
                d(h, !0) && f.redraw()
            },
            remove: function (a) {
                for (var g = this.chart, h = this.coll, f = this.series, e = f.length; e--;) f[e] && f[e].remove(!1);
                E(g.axes, this);
                E(g[h], this);
                u(g.options[h]) ? g.options[h].splice(this.options.index, 1) : delete g.options[h];
                g[h].forEach(function (a, b) {
                    a.options.index = a.userOptions.index =
                        b
                });
                this.destroy();
                g.isDirtyBox = !0;
                d(a, !0) && g.redraw()
            },
            setTitle: function (a, d) {
                this.update({
                    title: a
                }, d)
            },
            setCategories: function (a, d) {
                this.update({
                    categories: a
                }, d)
            }
        })
    });
    O(n, "Series/AreaSeries.js", [n["Core/Globals.js"], n["Core/Color.js"], n["Mixins/LegendSymbol.js"], n["Core/Utilities.js"]], function (f, a, n, y) {
        var D = a.parse,
            G = y.objectEach,
            C = y.pick;
        a = y.seriesType;
        var J = f.Series;
        a("area", "line", {
            threshold: 0
        }, {
            singleStacks: !1,
            getStackPoints: function (a) {
                var f = [],
                    n = [],
                    q = this.xAxis,
                    H = this.yAxis,
                    E = H.stacking.stacks[this.stackKey],
                    p = {},
                    t = this.index,
                    I = H.series,
                    u = I.length,
                    m = C(H.options.reversedStacks, !0) ? 1 : -1,
                    h;
                a = a || this.points;
                if (this.options.stacking) {
                    for (h = 0; h < a.length; h++) a[h].leftNull = a[h].rightNull = void 0, p[a[h].x] = a[h];
                    G(E, function (a, g) {
                        null !== a.total && n.push(g)
                    });
                    n.sort(function (a, g) {
                        return a - g
                    });
                    var l = I.map(function (a) {
                        return a.visible
                    });
                    n.forEach(function (a, g) {
                        var d = 0,
                            k, r;
                        if (p[a] && !p[a].isNull) f.push(p[a]), [-1, 1].forEach(function (d) {
                            var f = 1 === d ? "rightNull" : "leftNull",
                                q = 0,
                                x = E[n[g + d]];
                            if (x)
                                for (h = t; 0 <= h && h < u;) k = x.points[h],
                                    k || (h === t ? p[a][f] = !0 : l[h] && (r = E[a].points[h]) && (q -= r[1] - r[0])), h += m;
                            p[a][1 === d ? "rightCliff" : "leftCliff"] = q
                        });
                        else {
                            for (h = t; 0 <= h && h < u;) {
                                if (k = E[a].points[h]) {
                                    d = k[1];
                                    break
                                }
                                h += m
                            }
                            d = H.translate(d, 0, 1, 0, 1);
                            f.push({
                                isNull: !0,
                                plotX: q.translate(a, 0, 0, 0, 1),
                                x: a,
                                plotY: d,
                                yBottom: d
                            })
                        }
                    })
                }
                return f
            },
            getGraphPath: function (a) {
                var f = J.prototype.getGraphPath,
                    n = this.options,
                    q = n.stacking,
                    y = this.yAxis,
                    E, p = [],
                    t = [],
                    I = this.index,
                    u = y.stacking.stacks[this.stackKey],
                    m = n.threshold,
                    h = Math.round(y.getThreshold(n.threshold));
                n = C(n.connectNulls,
                    "percent" === q);
                var l = function (d, f, k) {
                    var l = a[d];
                    d = q && u[l.x].points[I];
                    var r = l[k + "Null"] || 0;
                    k = l[k + "Cliff"] || 0;
                    l = !0;
                    if (k || r) {
                        var n = (r ? d[0] : d[1]) + k;
                        var x = d[0] + k;
                        l = !!r
                    } else !q && a[f] && a[f].isNull && (n = x = m);
                    "undefined" !== typeof n && (t.push({
                        plotX: g,
                        plotY: null === n ? h : y.getThreshold(n),
                        isNull: l,
                        isCliff: !0
                    }), p.push({
                        plotX: g,
                        plotY: null === x ? h : y.getThreshold(x),
                        doCurve: !1
                    }))
                };
                a = a || this.points;
                q && (a = this.getStackPoints(a));
                for (E = 0; E < a.length; E++) {
                    q || (a[E].leftCliff = a[E].rightCliff = a[E].leftNull = a[E].rightNull = void 0);
                    var k = a[E].isNull;
                    var g = C(a[E].rectPlotX, a[E].plotX);
                    var d = q ? a[E].yBottom : h;
                    if (!k || n) n || l(E, E - 1, "left"), k && !q && n || (t.push(a[E]), p.push({
                        x: E,
                        plotX: g,
                        plotY: d
                    })), n || l(E, E + 1, "right")
                }
                E = f.call(this, t, !0, !0);
                p.reversed = !0;
                k = f.call(this, p, !0, !0);
                (d = k[0]) && "M" === d[0] && (k[0] = ["L", d[1], d[2]]);
                k = E.concat(k);
                f = f.call(this, t, !1, n);
                k.xMap = E.xMap;
                this.areaPath = k;
                return f
            },
            drawGraph: function () {
                this.areaPath = [];
                J.prototype.drawGraph.apply(this);
                var a = this,
                    f = this.areaPath,
                    n = this.options,
                    q = [
                        ["area", "highcharts-area",
                            this.color, n.fillColor
                        ]
                    ];
                this.zones.forEach(function (f, v) {
                    q.push(["zone-area-" + v, "highcharts-area highcharts-zone-area-" + v + " " + f.className, f.color || a.color, f.fillColor || n.fillColor])
                });
                q.forEach(function (q) {
                    var v = q[0],
                        p = a[v],
                        t = p ? "animate" : "attr",
                        I = {};
                    p ? (p.endX = a.preventGraphAnimation ? null : f.xMap, p.animate({
                        d: f
                    })) : (I.zIndex = 0, p = a[v] = a.chart.renderer.path(f).addClass(q[1]).add(a.group), p.isArea = !0);
                    a.chart.styledMode || (I.fill = C(q[3], D(q[2]).setOpacity(C(n.fillOpacity, .75)).get()));
                    p[t](I);
                    p.startX =
                        f.xMap;
                    p.shiftUnit = n.step ? 2 : 1
                })
            },
            drawLegendSymbol: n.drawRectangle
        });
        ""
    });
    O(n, "Series/SplineSeries.js", [n["Core/Utilities.js"]], function (f) {
        var a = f.pick;
        f = f.seriesType;
        f("spline", "line", {}, {
            getPointSpline: function (f, n, D) {
                var y = n.plotX || 0,
                    C = n.plotY || 0,
                    J = f[D - 1];
                D = f[D + 1];
                if (J && !J.isNull && !1 !== J.doCurve && !n.isCliff && D && !D.isNull && !1 !== D.doCurve && !n.isCliff) {
                    f = J.plotY || 0;
                    var H = D.plotX || 0;
                    D = D.plotY || 0;
                    var v = 0;
                    var L = (1.5 * y + (J.plotX || 0)) / 2.5;
                    var q = (1.5 * C + f) / 2.5;
                    H = (1.5 * y + H) / 2.5;
                    var K = (1.5 * C + D) / 2.5;
                    H !== L && (v =
                        (K - q) * (H - y) / (H - L) + C - K);
                    q += v;
                    K += v;
                    q > f && q > C ? (q = Math.max(f, C), K = 2 * C - q) : q < f && q < C && (q = Math.min(f, C), K = 2 * C - q);
                    K > D && K > C ? (K = Math.max(D, C), q = 2 * C - K) : K < D && K < C && (K = Math.min(D, C), q = 2 * C - K);
                    n.rightContX = H;
                    n.rightContY = K
                }
                n = ["C", a(J.rightContX, J.plotX, 0), a(J.rightContY, J.plotY, 0), a(L, y, 0), a(q, C, 0), y, C];
                J.rightContX = J.rightContY = void 0;
                return n
            }
        });
        ""
    });
    O(n, "Series/AreaSplineSeries.js", [n["Core/Globals.js"], n["Mixins/LegendSymbol.js"], n["Core/Options.js"], n["Core/Utilities.js"]], function (f, a, n, y) {
        y = y.seriesType;
        f = f.seriesTypes.area.prototype;
        y("areaspline", "spline", n.defaultOptions.plotOptions.area, {
            getStackPoints: f.getStackPoints,
            getGraphPath: f.getGraphPath,
            drawGraph: f.drawGraph,
            drawLegendSymbol: a.drawRectangle
        });
        ""
    });
    O(n, "Series/ColumnSeries.js", [n["Core/Globals.js"], n["Core/Color.js"], n["Mixins/LegendSymbol.js"], n["Core/Utilities.js"]], function (f, a, n, y) {
        "";
        var D = a.parse,
            G = y.animObject,
            C = y.clamp,
            J = y.defined,
            H = y.extend,
            v = y.isNumber,
            L = y.merge,
            q = y.pick;
        a = y.seriesType;
        var K = y.objectEach,
            E = f.Series;
        a("column", "line", {
            borderRadius: 0,
            centerInCategory: !1,
            groupPadding: .2,
            marker: null,
            pointPadding: .1,
            minPointLength: 0,
            cropThreshold: 50,
            pointRange: null,
            states: {
                hover: {
                    halo: !1,
                    brightness: .1
                },
                select: {
                    color: "#cccccc",
                    borderColor: "#000000"
                }
            },
            dataLabels: {
                align: void 0,
                verticalAlign: void 0,
                y: void 0
            },
            startFromThreshold: !0,
            stickyTracking: !1,
            tooltip: {
                distance: 6
            },
            threshold: 0,
            borderColor: "#ffffff"
        }, {
            cropShoulder: 0,
            directTouch: !0,
            trackerGroups: ["group", "dataLabelsGroup"],
            negStacks: !0,
            init: function () {
                E.prototype.init.apply(this, arguments);
                var a = this,
                    f = a.chart;
                f.hasRendered &&
                    f.series.forEach(function (f) {
                        f.type === a.type && (f.isDirty = !0)
                    })
            },
            getColumnMetrics: function () {
                var a = this,
                    f = a.options,
                    n = a.xAxis,
                    v = a.yAxis,
                    m = n.options.reversedStacks;
                m = n.reversed && !m || !n.reversed && m;
                var h, l = {},
                    k = 0;
                !1 === f.grouping ? k = 1 : a.chart.series.forEach(function (d) {
                    var g = d.yAxis,
                        f = d.options;
                    if (d.type === a.type && (d.visible || !a.chart.options.chart.ignoreHiddenSeries) && v.len === g.len && v.pos === g.pos) {
                        if (f.stacking && "group" !== f.stacking) {
                            h = d.stackKey;
                            "undefined" === typeof l[h] && (l[h] = k++);
                            var m = l[h]
                        } else !1 !==
                            f.grouping && (m = k++);
                        d.columnIndex = m
                    }
                });
                var g = Math.min(Math.abs(n.transA) * (n.ordinal && n.ordinal.slope || f.pointRange || n.closestPointRange || n.tickInterval || 1), n.len),
                    d = g * f.groupPadding,
                    x = (g - 2 * d) / (k || 1);
                f = Math.min(f.maxPointWidth || n.len, q(f.pointWidth, x * (1 - 2 * f.pointPadding)));
                a.columnMetrics = {
                    width: f,
                    offset: (x - f) / 2 + (d + ((a.columnIndex || 0) + (m ? 1 : 0)) * x - g / 2) * (m ? -1 : 1),
                    paddedWidth: x,
                    columnCount: k
                };
                return a.columnMetrics
            },
            crispCol: function (a, f, n, q) {
                var m = this.chart,
                    h = this.borderWidth,
                    l = -(h % 2 ? .5 : 0);
                h = h % 2 ? .5 : 1;
                m.inverted && m.renderer.isVML && (h += 1);
                this.options.crisp && (n = Math.round(a + n) + l, a = Math.round(a) + l, n -= a);
                q = Math.round(f + q) + h;
                l = .5 >= Math.abs(f) && .5 < q;
                f = Math.round(f) + h;
                q -= f;
                l && q && (--f, q += 1);
                return {
                    x: a,
                    y: f,
                    width: n,
                    height: q
                }
            },
            adjustForMissingColumns: function (a, n, q, v) {
                var m = this,
                    h = this.options.stacking;
                if (!q.isNull && 1 < v.columnCount) {
                    var l = 0,
                        k = 0;
                    K(this.yAxis.stacking && this.yAxis.stacking.stacks, function (a) {
                        if ("number" === typeof q.x && (a = a[q.x.toString()])) {
                            var d = a.points[m.index],
                                g = a.total;
                            h ? (d && (l = k), a.hasValidPoints &&
                                k++) : f.isArray(d) && (l = d[1], k = g || 0)
                        }
                    });
                    a = (q.plotX || 0) + ((k - 1) * v.paddedWidth + n) / 2 - n - l * v.paddedWidth
                }
                return a
            },
            translate: function () {
                var a = this,
                    f = a.chart,
                    n = a.options,
                    u = a.dense = 2 > a.closestPointRange * a.xAxis.transA;
                u = a.borderWidth = q(n.borderWidth, u ? 0 : 1);
                var m = a.xAxis,
                    h = a.yAxis,
                    l = n.threshold,
                    k = a.translatedThreshold = h.getThreshold(l),
                    g = q(n.minPointLength, 5),
                    d = a.getColumnMetrics(),
                    x = d.width,
                    r = a.barW = Math.max(x, 1 + 2 * u),
                    A = a.pointXOffset = d.offset,
                    y = a.dataMin,
                    B = a.dataMax;
                f.inverted && (k -= .5);
                n.pointPadding && (r = Math.ceil(r));
                E.prototype.translate.apply(a);
                a.points.forEach(function (p) {
                    var t = q(p.yBottom, k),
                        F = 999 + Math.abs(t),
                        e = x,
                        c = p.plotX || 0;
                    F = C(p.plotY, -F, h.len + F);
                    var b = c + A,
                        u = r,
                        w = Math.min(F, t),
                        E = Math.max(F, t) - w;
                    if (g && Math.abs(E) < g) {
                        E = g;
                        var M = !h.reversed && !p.negative || h.reversed && p.negative;
                        v(l) && v(B) && p.y === l && B <= l && (h.min || 0) < l && y !== B && (M = !M);
                        w = Math.abs(w - k) > g ? t - g : k - (M ? g : 0)
                    }
                    J(p.options.pointWidth) && (e = u = Math.ceil(p.options.pointWidth), b -= Math.round((e - x) / 2));
                    n.centerInCategory && (b = a.adjustForMissingColumns(b, e, p, d));
                    p.barX =
                        b;
                    p.pointWidth = e;
                    p.tooltipPos = f.inverted ? [h.len + h.pos - f.plotLeft - F, m.len + m.pos - f.plotTop - (c || 0) - A - u / 2, E] : [b + u / 2, F + h.pos - f.plotTop, E];
                    p.shapeType = a.pointClass.prototype.shapeType || "rect";
                    p.shapeArgs = a.crispCol.apply(a, p.isNull ? [b, k, u, 0] : [b, w, u, E])
                })
            },
            getSymbol: f.noop,
            drawLegendSymbol: n.drawRectangle,
            drawGraph: function () {
                this.group[this.dense ? "addClass" : "removeClass"]("highcharts-dense-data")
            },
            pointAttribs: function (a, f) {
                var p = this.options,
                    n = this.pointAttrToOptions || {};
                var m = n.stroke || "borderColor";
                var h = n["stroke-width"] || "borderWidth",
                    l = a && a.color || this.color,
                    k = a && a[m] || p[m] || this.color || l,
                    g = a && a[h] || p[h] || this[h] || 0;
                n = a && a.options.dashStyle || p.dashStyle;
                var d = q(a && a.opacity, p.opacity, 1);
                if (a && this.zones.length) {
                    var x = a.getZone();
                    l = a.options.color || x && (x.color || a.nonZonedColor) || this.color;
                    x && (k = x.borderColor || k, n = x.dashStyle || n, g = x.borderWidth || g)
                }
                f && a && (a = L(p.states[f], a.options.states && a.options.states[f] || {}), f = a.brightness, l = a.color || "undefined" !== typeof f && D(l).brighten(a.brightness).get() ||
                    l, k = a[m] || k, g = a[h] || g, n = a.dashStyle || n, d = q(a.opacity, d));
                m = {
                    fill: l,
                    stroke: k,
                    "stroke-width": g,
                    opacity: d
                };
                n && (m.dashstyle = n);
                return m
            },
            drawPoints: function () {
                var a = this,
                    f = this.chart,
                    n = a.options,
                    q = f.renderer,
                    m = n.animationLimit || 250,
                    h;
                a.points.forEach(function (l) {
                    var k = l.graphic,
                        g = !!k,
                        d = k && f.pointCount < m ? "animate" : "attr";
                    if (v(l.plotY) && null !== l.y) {
                        h = l.shapeArgs;
                        k && l.hasNewShapeType() && (k = k.destroy());
                        a.enabledDataSorting && (l.startXPos = a.xAxis.reversed ? -(h ? h.width : 0) : a.xAxis.width);
                        k || (l.graphic = k = q[l.shapeType](h).add(l.group ||
                            a.group)) && a.enabledDataSorting && f.hasRendered && f.pointCount < m && (k.attr({
                            x: l.startXPos
                        }), g = !0, d = "animate");
                        if (k && g) k[d](L(h));
                        if (n.borderRadius) k[d]({
                            r: n.borderRadius
                        });
                        f.styledMode || k[d](a.pointAttribs(l, l.selected && "select")).shadow(!1 !== l.allowShadow && n.shadow, null, n.stacking && !n.borderRadius);
                        k.addClass(l.getClassName(), !0)
                    } else k && (l.graphic = k.destroy())
                })
            },
            animate: function (a) {
                var f = this,
                    p = this.yAxis,
                    n = f.options,
                    m = this.chart.inverted,
                    h = {},
                    l = m ? "translateX" : "translateY";
                if (a) h.scaleY = .001, a = C(p.toPixels(n.threshold),
                    p.pos, p.pos + p.len), m ? h.translateX = a - p.len : h.translateY = a, f.clipBox && f.setClip(), f.group.attr(h);
                else {
                    var k = f.group.attr(l);
                    f.group.animate({
                        scaleY: 1
                    }, H(G(f.options.animation), {
                        step: function (a, d) {
                            f.group && (h[l] = k + d.pos * (p.pos - k), f.group.attr(h))
                        }
                    }))
                }
            },
            remove: function () {
                var a = this,
                    f = a.chart;
                f.hasRendered && f.series.forEach(function (f) {
                    f.type === a.type && (f.isDirty = !0)
                });
                E.prototype.remove.apply(a, arguments)
            }
        });
        ""
    });
    O(n, "Series/BarSeries.js", [n["Core/Utilities.js"]], function (f) {
        f = f.seriesType;
        f("bar", "column",
            null, {
                inverted: !0
            });
        ""
    });
    O(n, "Series/ScatterSeries.js", [n["Core/Globals.js"], n["Core/Utilities.js"]], function (f, a) {
        var n = a.addEvent;
        a = a.seriesType;
        var y = f.Series;
        a("scatter", "line", {
            lineWidth: 0,
            findNearestPointBy: "xy",
            jitter: {
                x: 0,
                y: 0
            },
            marker: {
                enabled: !0
            },
            tooltip: {
                headerFormat: '<span style="color:{point.color}">\u25cf</span> <span style="font-size: 10px"> {series.name}</span><br/>',
                pointFormat: "x: <b>{point.x}</b><br/>y: <b>{point.y}</b><br/>"
            }
        }, {
            sorted: !1,
            requireSorting: !1,
            noSharedTooltip: !0,
            trackerGroups: ["group",
                "markerGroup", "dataLabelsGroup"
            ],
            takeOrdinalPosition: !1,
            drawGraph: function () {
                this.options.lineWidth && y.prototype.drawGraph.call(this)
            },
            applyJitter: function () {
                var a = this,
                    f = this.options.jitter,
                    n = this.points.length;
                f && this.points.forEach(function (C, y) {
                    ["x", "y"].forEach(function (v, D) {
                        var q = "plot" + v.toUpperCase();
                        if (f[v] && !C.isNull) {
                            var H = a[v + "Axis"];
                            var E = f[v] * H.transA;
                            if (H && !H.isLog) {
                                var p = Math.max(0, C[q] - E);
                                H = Math.min(H.len, C[q] + E);
                                D = 1E4 * Math.sin(y + D * n);
                                C[q] = p + (H - p) * (D - Math.floor(D));
                                "x" === v && (C.clientX =
                                    C.plotX)
                            }
                        }
                    })
                })
            }
        });
        n(y, "afterTranslate", function () {
            this.applyJitter && this.applyJitter()
        });
        ""
    });
    O(n, "Mixins/CenteredSeries.js", [n["Core/Globals.js"], n["Core/Utilities.js"]], function (f, a) {
        var n = a.isNumber,
            y = a.pick,
            D = a.relativeLength,
            G = f.deg2rad;
        return f.CenteredSeriesMixin = {
            getCenter: function () {
                var a = this.options,
                    n = this.chart,
                    H = 2 * (a.slicedOffset || 0),
                    v = n.plotWidth - 2 * H,
                    G = n.plotHeight - 2 * H,
                    q = a.center,
                    K = Math.min(v, G),
                    E = a.size,
                    p = a.innerSize || 0;
                "string" === typeof E && (E = parseFloat(E));
                "string" === typeof p && (p =
                    parseFloat(p));
                a = [y(q[0], "50%"), y(q[1], "50%"), y(E && 0 > E ? void 0 : a.size, "100%"), y(p && 0 > p ? void 0 : a.innerSize || 0, "0%")];
                !n.angular || this instanceof f.Series || (a[3] = 0);
                for (q = 0; 4 > q; ++q) E = a[q], n = 2 > q || 2 === q && /%$/.test(E), a[q] = D(E, [v, G, K, a[2]][q]) + (n ? H : 0);
                a[3] > a[2] && (a[3] = a[2]);
                return a
            },
            getStartAndEndRadians: function (a, f) {
                a = n(a) ? a : 0;
                f = n(f) && f > a && 360 > f - a ? f : a + 360;
                return {
                    start: G * (a + -90),
                    end: G * (f + -90)
                }
            }
        }
    });
    O(n, "Series/PieSeries.js", [n["Core/Globals.js"], n["Core/Renderer/SVG/SVGRenderer.js"], n["Mixins/LegendSymbol.js"],
        n["Core/Series/Point.js"], n["Core/Utilities.js"], n["Mixins/CenteredSeries.js"]
    ], function (f, a, n, y, D, G) {
        var C = D.addEvent,
            J = D.clamp,
            H = D.defined,
            v = D.fireEvent,
            L = D.isNumber,
            q = D.merge,
            K = D.pick,
            E = D.relativeLength,
            p = D.seriesType,
            t = D.setAnimation,
            I = G.getStartAndEndRadians;
        D = f.noop;
        var u = f.Series;
        p("pie", "line", {
            center: [null, null],
            clip: !1,
            colorByPoint: !0,
            dataLabels: {
                allowOverlap: !0,
                connectorPadding: 5,
                connectorShape: "fixedOffset",
                crookDistance: "70%",
                distance: 30,
                enabled: !0,
                formatter: function () {
                    return this.point.isNull ?
                        void 0 : this.point.name
                },
                softConnector: !0,
                x: 0
            },
            fillColor: void 0,
            ignoreHiddenPoint: !0,
            inactiveOtherPoints: !0,
            legendType: "point",
            marker: null,
            size: null,
            showInLegend: !1,
            slicedOffset: 10,
            stickyTracking: !1,
            tooltip: {
                followPointer: !0
            },
            borderColor: "#ffffff",
            borderWidth: 1,
            lineWidth: void 0,
            states: {
                hover: {
                    brightness: .1
                }
            }
        }, {
            isCartesian: !1,
            requireSorting: !1,
            directTouch: !0,
            noSharedTooltip: !0,
            trackerGroups: ["group", "dataLabelsGroup"],
            axisTypes: [],
            pointAttribs: f.seriesTypes.column.prototype.pointAttribs,
            animate: function (a) {
                var f =
                    this,
                    l = f.points,
                    k = f.startAngleRad;
                a || l.forEach(function (a) {
                    var d = a.graphic,
                        g = a.shapeArgs;
                    d && g && (d.attr({
                        r: K(a.startR, f.center && f.center[3] / 2),
                        start: k,
                        end: k
                    }), d.animate({
                        r: g.r,
                        start: g.start,
                        end: g.end
                    }, f.options.animation))
                })
            },
            hasData: function () {
                return !!this.processedXData.length
            },
            updateTotals: function () {
                var a, f = 0,
                    l = this.points,
                    k = l.length,
                    g = this.options.ignoreHiddenPoint;
                for (a = 0; a < k; a++) {
                    var d = l[a];
                    f += g && !d.visible ? 0 : d.isNull ? 0 : d.y
                }
                this.total = f;
                for (a = 0; a < k; a++) d = l[a], d.percentage = 0 < f && (d.visible || !g) ?
                    d.y / f * 100 : 0, d.total = f
            },
            generatePoints: function () {
                u.prototype.generatePoints.call(this);
                this.updateTotals()
            },
            getX: function (a, f, l) {
                var h = this.center,
                    g = this.radii ? this.radii[l.index] : h[2] / 2;
                a = Math.asin(J((a - h[1]) / (g + l.labelDistance), -1, 1));
                return h[0] + (f ? -1 : 1) * Math.cos(a) * (g + l.labelDistance) + (0 < l.labelDistance ? (f ? -1 : 1) * this.options.dataLabels.padding : 0)
            },
            translate: function (a) {
                this.generatePoints();
                var f = 0,
                    l = this.options,
                    k = l.slicedOffset,
                    g = k + (l.borderWidth || 0),
                    d = I(l.startAngle, l.endAngle),
                    m = this.startAngleRad =
                    d.start;
                d = (this.endAngleRad = d.end) - m;
                var n = this.points,
                    p = l.dataLabels.distance;
                l = l.ignoreHiddenPoint;
                var q, t = n.length;
                a || (this.center = a = this.getCenter());
                for (q = 0; q < t; q++) {
                    var u = n[q];
                    var y = m + f * d;
                    if (!l || u.visible) f += u.percentage / 100;
                    var F = m + f * d;
                    u.shapeType = "arc";
                    u.shapeArgs = {
                        x: a[0],
                        y: a[1],
                        r: a[2] / 2,
                        innerR: a[3] / 2,
                        start: Math.round(1E3 * y) / 1E3,
                        end: Math.round(1E3 * F) / 1E3
                    };
                    u.labelDistance = K(u.options.dataLabels && u.options.dataLabels.distance, p);
                    u.labelDistance = E(u.labelDistance, u.shapeArgs.r);
                    this.maxLabelDistance =
                        Math.max(this.maxLabelDistance || 0, u.labelDistance);
                    F = (F + y) / 2;
                    F > 1.5 * Math.PI ? F -= 2 * Math.PI : F < -Math.PI / 2 && (F += 2 * Math.PI);
                    u.slicedTranslation = {
                        translateX: Math.round(Math.cos(F) * k),
                        translateY: Math.round(Math.sin(F) * k)
                    };
                    var e = Math.cos(F) * a[2] / 2;
                    var c = Math.sin(F) * a[2] / 2;
                    u.tooltipPos = [a[0] + .7 * e, a[1] + .7 * c];
                    u.half = F < -Math.PI / 2 || F > Math.PI / 2 ? 1 : 0;
                    u.angle = F;
                    y = Math.min(g, u.labelDistance / 5);
                    u.labelPosition = {
                        natural: {
                            x: a[0] + e + Math.cos(F) * u.labelDistance,
                            y: a[1] + c + Math.sin(F) * u.labelDistance
                        },
                        "final": {},
                        alignment: 0 >
                            u.labelDistance ? "center" : u.half ? "right" : "left",
                        connectorPosition: {
                            breakAt: {
                                x: a[0] + e + Math.cos(F) * y,
                                y: a[1] + c + Math.sin(F) * y
                            },
                            touchingSliceAt: {
                                x: a[0] + e,
                                y: a[1] + c
                            }
                        }
                    }
                }
                v(this, "afterTranslate")
            },
            drawEmpty: function () {
                var f = this.startAngleRad,
                    h = this.endAngleRad,
                    l = this.options;
                if (0 === this.total && this.center) {
                    var k = this.center[0];
                    var g = this.center[1];
                    this.graph || (this.graph = this.chart.renderer.arc(k, g, this.center[1] / 2, 0, f, h).addClass("highcharts-empty-series").add(this.group));
                    this.graph.attr({
                        d: a.prototype.symbols.arc(k,
                            g, this.center[2] / 2, 0, {
                                start: f,
                                end: h,
                                innerR: this.center[3] / 2
                            })
                    });
                    this.chart.styledMode || this.graph.attr({
                        "stroke-width": l.borderWidth,
                        fill: l.fillColor || "none",
                        stroke: l.color || "#cccccc"
                    })
                } else this.graph && (this.graph = this.graph.destroy())
            },
            redrawPoints: function () {
                var a = this,
                    f = a.chart,
                    l = f.renderer,
                    k, g, d, n, p = a.options.shadow;
                this.drawEmpty();
                !p || a.shadowGroup || f.styledMode || (a.shadowGroup = l.g("shadow").attr({
                    zIndex: -1
                }).add(a.group));
                a.points.forEach(function (h) {
                    var m = {};
                    g = h.graphic;
                    if (!h.isNull && g) {
                        n =
                            h.shapeArgs;
                        k = h.getTranslate();
                        if (!f.styledMode) {
                            var r = h.shadowGroup;
                            p && !r && (r = h.shadowGroup = l.g("shadow").add(a.shadowGroup));
                            r && r.attr(k);
                            d = a.pointAttribs(h, h.selected && "select")
                        }
                        h.delayedRendering ? (g.setRadialReference(a.center).attr(n).attr(k), f.styledMode || g.attr(d).attr({
                            "stroke-linejoin": "round"
                        }).shadow(p, r), h.delayedRendering = !1) : (g.setRadialReference(a.center), f.styledMode || q(!0, m, d), q(!0, m, n, k), g.animate(m));
                        g.attr({
                            visibility: h.visible ? "inherit" : "hidden"
                        });
                        g.addClass(h.getClassName())
                    } else g &&
                        (h.graphic = g.destroy())
                })
            },
            drawPoints: function () {
                var a = this.chart.renderer;
                this.points.forEach(function (f) {
                    f.graphic && f.hasNewShapeType() && (f.graphic = f.graphic.destroy());
                    f.graphic || (f.graphic = a[f.shapeType](f.shapeArgs).add(f.series.group), f.delayedRendering = !0)
                })
            },
            searchPoint: D,
            sortByAngle: function (a, f) {
                a.sort(function (a, h) {
                    return "undefined" !== typeof a.angle && (h.angle - a.angle) * f
                })
            },
            drawLegendSymbol: n.drawRectangle,
            getCenter: G.getCenter,
            getSymbol: D,
            drawGraph: null
        }, {
            init: function () {
                y.prototype.init.apply(this,
                    arguments);
                var a = this;
                a.name = K(a.name, "Slice");
                var f = function (f) {
                    a.slice("select" === f.type)
                };
                C(a, "select", f);
                C(a, "unselect", f);
                return a
            },
            isValid: function () {
                return L(this.y) && 0 <= this.y
            },
            setVisible: function (a, f) {
                var h = this,
                    k = h.series,
                    g = k.chart,
                    d = k.options.ignoreHiddenPoint;
                f = K(f, d);
                a !== h.visible && (h.visible = h.options.visible = a = "undefined" === typeof a ? !h.visible : a, k.options.data[k.data.indexOf(h)] = h.options, ["graphic", "dataLabel", "connector", "shadowGroup"].forEach(function (d) {
                        if (h[d]) h[d][a ? "show" : "hide"](!0)
                    }),
                    h.legendItem && g.legend.colorizeItem(h, a), a || "hover" !== h.state || h.setState(""), d && (k.isDirty = !0), f && g.redraw())
            },
            slice: function (a, f, l) {
                var h = this.series;
                t(l, h.chart);
                K(f, !0);
                this.sliced = this.options.sliced = H(a) ? a : !this.sliced;
                h.options.data[h.data.indexOf(this)] = this.options;
                this.graphic && this.graphic.animate(this.getTranslate());
                this.shadowGroup && this.shadowGroup.animate(this.getTranslate())
            },
            getTranslate: function () {
                return this.sliced ? this.slicedTranslation : {
                    translateX: 0,
                    translateY: 0
                }
            },
            haloPath: function (a) {
                var f =
                    this.shapeArgs;
                return this.sliced || !this.visible ? [] : this.series.chart.renderer.symbols.arc(f.x, f.y, f.r + a, f.r + a, {
                    innerR: f.r - 1,
                    start: f.start,
                    end: f.end
                })
            },
            connectorShapes: {
                fixedOffset: function (a, f, l) {
                    var h = f.breakAt;
                    f = f.touchingSliceAt;
                    return [
                        ["M", a.x, a.y], l.softConnector ? ["C", a.x + ("left" === a.alignment ? -5 : 5), a.y, 2 * h.x - f.x, 2 * h.y - f.y, h.x, h.y] : ["L", h.x, h.y],
                        ["L", f.x, f.y]
                    ]
                },
                straight: function (a, f) {
                    f = f.touchingSliceAt;
                    return [
                        ["M", a.x, a.y],
                        ["L", f.x, f.y]
                    ]
                },
                crookedLine: function (a, f, l) {
                    f = f.touchingSliceAt;
                    var h =
                        this.series,
                        g = h.center[0],
                        d = h.chart.plotWidth,
                        m = h.chart.plotLeft;
                    h = a.alignment;
                    var n = this.shapeArgs.r;
                    l = E(l.crookDistance, 1);
                    d = "left" === h ? g + n + (d + m - g - n) * (1 - l) : m + (g - n) * l;
                    l = ["L", d, a.y];
                    g = !0;
                    if ("left" === h ? d > a.x || d < f.x : d < a.x || d > f.x) g = !1;
                    a = [
                        ["M", a.x, a.y]
                    ];
                    g && a.push(l);
                    a.push(["L", f.x, f.y]);
                    return a
                }
            },
            getConnectorPath: function () {
                var a = this.labelPosition,
                    f = this.series.options.dataLabels,
                    l = f.connectorShape,
                    k = this.connectorShapes;
                k[l] && (l = k[l]);
                return l.call(this, {
                        x: a.final.x,
                        y: a.final.y,
                        alignment: a.alignment
                    },
                    a.connectorPosition, f)
            }
        });
        ""
    });
    O(n, "Core/Series/DataLabels.js", [n["Core/Globals.js"], n["Core/Utilities.js"]], function (f, a) {
        var n = f.noop,
            y = f.seriesTypes,
            D = a.arrayMax,
            G = a.clamp,
            C = a.defined,
            J = a.extend,
            H = a.fireEvent,
            v = a.format,
            L = a.getDeferredAnimation,
            q = a.isArray,
            K = a.merge,
            E = a.objectEach,
            p = a.pick,
            t = a.relativeLength,
            I = a.splat,
            u = a.stableSort,
            m = f.Series;
        f.distribute = function (a, l, k) {
            function g(a, d) {
                return a.target - d.target
            }
            var d, h = !0,
                m = a,
                n = [];
            var q = 0;
            var t = m.reducedLen || l;
            for (d = a.length; d--;) q += a[d].size;
            if (q > t) {
                u(a, function (a, d) {
                    return (d.rank || 0) - (a.rank || 0)
                });
                for (q = d = 0; q <= t;) q += a[d].size, d++;
                n = a.splice(d - 1, a.length)
            }
            u(a, g);
            for (a = a.map(function (a) {
                    return {
                        size: a.size,
                        targets: [a.target],
                        align: p(a.align, .5)
                    }
                }); h;) {
                for (d = a.length; d--;) h = a[d], q = (Math.min.apply(0, h.targets) + Math.max.apply(0, h.targets)) / 2, h.pos = G(q - h.size * h.align, 0, l - h.size);
                d = a.length;
                for (h = !1; d--;) 0 < d && a[d - 1].pos + a[d - 1].size > a[d].pos && (a[d - 1].size += a[d].size, a[d - 1].targets = a[d - 1].targets.concat(a[d].targets), a[d - 1].align = .5, a[d - 1].pos +
                    a[d - 1].size > l && (a[d - 1].pos = l - a[d - 1].size), a.splice(d, 1), h = !0)
            }
            m.push.apply(m, n);
            d = 0;
            a.some(function (a) {
                var g = 0;
                if (a.targets.some(function () {
                        m[d].pos = a.pos + g;
                        if ("undefined" !== typeof k && Math.abs(m[d].pos - m[d].target) > k) return m.slice(0, d + 1).forEach(function (a) {
                            delete a.pos
                        }), m.reducedLen = (m.reducedLen || l) - .1 * l, m.reducedLen > .1 * l && f.distribute(m, l, k), !0;
                        g += m[d].size;
                        d++
                    })) return !0
            });
            u(m, g)
        };
        m.prototype.drawDataLabels = function () {
            function a(a, d) {
                var c = d.filter;
                return c ? (d = c.operator, a = a[c.property], c = c.value,
                    ">" === d && a > c || "<" === d && a < c || ">=" === d && a >= c || "<=" === d && a <= c || "==" === d && a == c || "===" === d && a === c ? !0 : !1) : !0
            }

            function f(a, d) {
                var c = [],
                    b;
                if (q(a) && !q(d)) c = a.map(function (a) {
                    return K(a, d)
                });
                else if (q(d) && !q(a)) c = d.map(function (b) {
                    return K(a, b)
                });
                else if (q(a) || q(d))
                    for (b = Math.max(a.length, d.length); b--;) c[b] = K(a[b], d[b]);
                else c = K(a, d);
                return c
            }
            var k = this,
                g = k.chart,
                d = k.options,
                m = d.dataLabels,
                n = k.points,
                t, u = k.hasRendered || 0,
                B = m.animation;
            B = m.defer ? L(g, B, k) : {
                defer: 0,
                duration: 0
            };
            var y = g.renderer;
            m = f(f(g.options.plotOptions &&
                g.options.plotOptions.series && g.options.plotOptions.series.dataLabels, g.options.plotOptions && g.options.plotOptions[k.type] && g.options.plotOptions[k.type].dataLabels), m);
            H(this, "drawDataLabels");
            if (q(m) || m.enabled || k._hasPointLabels) {
                var D = k.plotGroup("dataLabelsGroup", "data-labels", u ? "inherit" : "hidden", m.zIndex || 6);
                D.attr({
                    opacity: +u
                });
                !u && (u = k.dataLabelsGroup) && (k.visible && D.show(!0), u[d.animation ? "animate" : "attr"]({
                    opacity: 1
                }, B));
                n.forEach(function (h) {
                    t = I(f(m, h.dlOptions || h.options && h.options.dataLabels));
                    t.forEach(function (e, c) {
                        var b = e.enabled && (!h.isNull || h.dataLabelOnNull) && a(h, e),
                            f = h.dataLabels ? h.dataLabels[c] : h.dataLabel,
                            l = h.connectors ? h.connectors[c] : h.connector,
                            m = p(e.distance, h.labelDistance),
                            n = !f;
                        if (b) {
                            var r = h.getLabelConfig();
                            var q = p(e[h.formatPrefix + "Format"], e.format);
                            r = C(q) ? v(q, r, g) : (e[h.formatPrefix + "Formatter"] || e.formatter).call(r, e);
                            q = e.style;
                            var t = e.rotation;
                            g.styledMode || (q.color = p(e.color, q.color, k.color, "#000000"), "contrast" === q.color ? (h.contrastColor = y.getContrast(h.color || k.color),
                                q.color = !C(m) && e.inside || 0 > m || d.stacking ? h.contrastColor : "#000000") : delete h.contrastColor, d.cursor && (q.cursor = d.cursor));
                            var x = {
                                r: e.borderRadius || 0,
                                rotation: t,
                                padding: e.padding,
                                zIndex: 1
                            };
                            g.styledMode || (x.fill = e.backgroundColor, x.stroke = e.borderColor, x["stroke-width"] = e.borderWidth);
                            E(x, function (a, b) {
                                "undefined" === typeof a && delete x[b]
                            })
                        }!f || b && C(r) ? b && C(r) && (f ? x.text = r : (h.dataLabels = h.dataLabels || [], f = h.dataLabels[c] = t ? y.text(r, 0, -9999, e.useHTML).addClass("highcharts-data-label") : y.label(r, 0, -9999,
                            e.shape, null, null, e.useHTML, null, "data-label"), c || (h.dataLabel = f), f.addClass(" highcharts-data-label-color-" + h.colorIndex + " " + (e.className || "") + (e.useHTML ? " highcharts-tracker" : ""))), f.options = e, f.attr(x), g.styledMode || f.css(q).shadow(e.shadow), f.added || f.add(D), e.textPath && !e.useHTML && (f.setTextPath(h.getDataLabelPath && h.getDataLabelPath(f) || h.graphic, e.textPath), h.dataLabelPath && !e.textPath.enabled && (h.dataLabelPath = h.dataLabelPath.destroy())), k.alignDataLabel(h, f, e, null, n)) : (h.dataLabel = h.dataLabel &&
                            h.dataLabel.destroy(), h.dataLabels && (1 === h.dataLabels.length ? delete h.dataLabels : delete h.dataLabels[c]), c || delete h.dataLabel, l && (h.connector = h.connector.destroy(), h.connectors && (1 === h.connectors.length ? delete h.connectors : delete h.connectors[c])))
                    })
                })
            }
            H(this, "afterDrawDataLabels")
        };
        m.prototype.alignDataLabel = function (a, f, k, g, d) {
            var h = this,
                l = this.chart,
                m = this.isCartesian && l.inverted,
                n = this.enabledDataSorting,
                q = p(a.dlBox && a.dlBox.centerX, a.plotX, -9999),
                t = p(a.plotY, -9999),
                v = f.getBBox(),
                u = k.rotation,
                e = k.align,
                c = l.isInsidePlot(q, Math.round(t), m),
                b = "justify" === p(k.overflow, n ? "none" : "justify"),
                z = this.visible && !1 !== a.visible && (a.series.forceDL || n && !b || c || k.inside && g && l.isInsidePlot(q, m ? g.x + 1 : g.y + g.height - 1, m));
            var w = function (e) {
                n && h.xAxis && !b && h.setDataLabelStartPos(a, f, d, c, e)
            };
            if (z) {
                var y = l.renderer.fontMetrics(l.styledMode ? void 0 : k.style.fontSize, f).b;
                g = J({
                    x: m ? this.yAxis.len - t : q,
                    y: Math.round(m ? this.xAxis.len - q : t),
                    width: 0,
                    height: 0
                }, g);
                J(k, {
                    width: v.width,
                    height: v.height
                });
                u ? (b = !1, q = l.renderer.rotCorr(y,
                    u), q = {
                    x: g.x + (k.x || 0) + g.width / 2 + q.x,
                    y: g.y + (k.y || 0) + {
                        top: 0,
                        middle: .5,
                        bottom: 1
                    } [k.verticalAlign] * g.height
                }, w(q), f[d ? "attr" : "animate"](q).attr({
                    align: e
                }), w = (u + 720) % 360, w = 180 < w && 360 > w, "left" === e ? q.y -= w ? v.height : 0 : "center" === e ? (q.x -= v.width / 2, q.y -= v.height / 2) : "right" === e && (q.x -= v.width, q.y -= w ? 0 : v.height), f.placed = !0, f.alignAttr = q) : (w(g), f.align(k, null, g), q = f.alignAttr);
                b && 0 <= g.height ? this.justifyDataLabel(f, k, q, v, g, d) : p(k.crop, !0) && (z = l.isInsidePlot(q.x, q.y) && l.isInsidePlot(q.x + v.width, q.y + v.height));
                if (k.shape &&
                    !u) f[d ? "attr" : "animate"]({
                    anchorX: m ? l.plotWidth - a.plotY : a.plotX,
                    anchorY: m ? l.plotHeight - a.plotX : a.plotY
                })
            }
            d && n && (f.placed = !1);
            z || n && !b || (f.hide(!0), f.placed = !1)
        };
        m.prototype.setDataLabelStartPos = function (a, f, k, g, d) {
            var h = this.chart,
                l = h.inverted,
                m = this.xAxis,
                n = m.reversed,
                p = l ? f.height / 2 : f.width / 2;
            a = (a = a.pointWidth) ? a / 2 : 0;
            m = l ? d.x : n ? -p - a : m.width - p + a;
            d = l ? n ? this.yAxis.height - p + a : -p - a : d.y;
            f.startXPos = m;
            f.startYPos = d;
            g ? "hidden" === f.visibility && (f.show(), f.attr({
                opacity: 0
            }).animate({
                opacity: 1
            })) : f.attr({
                opacity: 1
            }).animate({
                    opacity: 0
                },
                void 0, f.hide);
            h.hasRendered && (k && f.attr({
                x: f.startXPos,
                y: f.startYPos
            }), f.placed = !0)
        };
        m.prototype.justifyDataLabel = function (a, f, k, g, d, m) {
            var h = this.chart,
                l = f.align,
                n = f.verticalAlign,
                p = a.box ? 0 : a.padding || 0,
                q = f.x;
            q = void 0 === q ? 0 : q;
            var t = f.y;
            var x = void 0 === t ? 0 : t;
            t = k.x + p;
            if (0 > t) {
                "right" === l && 0 <= q ? (f.align = "left", f.inside = !0) : q -= t;
                var e = !0
            }
            t = k.x + g.width - p;
            t > h.plotWidth && ("left" === l && 0 >= q ? (f.align = "right", f.inside = !0) : q += h.plotWidth - t, e = !0);
            t = k.y + p;
            0 > t && ("bottom" === n && 0 <= x ? (f.verticalAlign = "top", f.inside = !0) : x -= t, e = !0);
            t = k.y + g.height - p;
            t > h.plotHeight && ("top" === n && 0 >= x ? (f.verticalAlign = "bottom", f.inside = !0) : x += h.plotHeight - t, e = !0);
            e && (f.x = q, f.y = x, a.placed = !m, a.align(f, void 0, d));
            return e
        };
        y.pie && (y.pie.prototype.dataLabelPositioners = {
                radialDistributionY: function (a) {
                    return a.top + a.distributeBox.pos
                },
                radialDistributionX: function (a, f, k, g) {
                    return a.getX(k < f.top + 2 || k > f.bottom - 2 ? g : k, f.half, f)
                },
                justify: function (a, f, k) {
                    return k[0] + (a.half ? -1 : 1) * (f + a.labelDistance)
                },
                alignToPlotEdges: function (a, f, k, g) {
                    a = a.getBBox().width;
                    return f ? a + g : k - a - g
                },
                alignToConnectors: function (a, f, k, g) {
                    var d = 0,
                        h;
                    a.forEach(function (a) {
                        h = a.dataLabel.getBBox().width;
                        h > d && (d = h)
                    });
                    return f ? d + g : k - d - g
                }
            }, y.pie.prototype.drawDataLabels = function () {
                var a = this,
                    l = a.data,
                    k, g = a.chart,
                    d = a.options.dataLabels || {},
                    n = d.connectorPadding,
                    r, q = g.plotWidth,
                    t = g.plotHeight,
                    v = g.plotLeft,
                    u = Math.round(g.chartWidth / 3),
                    y, F = a.center,
                    e = F[2] / 2,
                    c = F[1],
                    b, z, w, E, H = [
                        [],
                        []
                    ],
                    G, I, J, L, O = [0, 0, 0, 0],
                    S = a.dataLabelPositioners,
                    V;
                a.visible && (d.enabled || a._hasPointLabels) && (l.forEach(function (a) {
                        a.dataLabel &&
                            a.visible && a.dataLabel.shortened && (a.dataLabel.attr({
                                width: "auto"
                            }).css({
                                width: "auto",
                                textOverflow: "clip"
                            }), a.dataLabel.shortened = !1)
                    }), m.prototype.drawDataLabels.apply(a), l.forEach(function (a) {
                        a.dataLabel && (a.visible ? (H[a.half].push(a), a.dataLabel._pos = null, !C(d.style.width) && !C(a.options.dataLabels && a.options.dataLabels.style && a.options.dataLabels.style.width) && a.dataLabel.getBBox().width > u && (a.dataLabel.css({
                            width: Math.round(.7 * u) + "px"
                        }), a.dataLabel.shortened = !0)) : (a.dataLabel = a.dataLabel.destroy(),
                            a.dataLabels && 1 === a.dataLabels.length && delete a.dataLabels))
                    }), H.forEach(function (h, l) {
                        var m = h.length,
                            r = [],
                            x;
                        if (m) {
                            a.sortByAngle(h, l - .5);
                            if (0 < a.maxLabelDistance) {
                                var u = Math.max(0, c - e - a.maxLabelDistance);
                                var A = Math.min(c + e + a.maxLabelDistance, g.plotHeight);
                                h.forEach(function (a) {
                                    0 < a.labelDistance && a.dataLabel && (a.top = Math.max(0, c - e - a.labelDistance), a.bottom = Math.min(c + e + a.labelDistance, g.plotHeight), x = a.dataLabel.getBBox().height || 21, a.distributeBox = {
                                        target: a.labelPosition.natural.y - a.top + x / 2,
                                        size: x,
                                        rank: a.y
                                    }, r.push(a.distributeBox))
                                });
                                u = A + x - u;
                                f.distribute(r, u, u / 5)
                            }
                            for (L = 0; L < m; L++) {
                                k = h[L];
                                w = k.labelPosition;
                                b = k.dataLabel;
                                J = !1 === k.visible ? "hidden" : "inherit";
                                I = u = w.natural.y;
                                r && C(k.distributeBox) && ("undefined" === typeof k.distributeBox.pos ? J = "hidden" : (E = k.distributeBox.size, I = S.radialDistributionY(k)));
                                delete k.positionIndex;
                                if (d.justify) G = S.justify(k, e, F);
                                else switch (d.alignTo) {
                                    case "connectors":
                                        G = S.alignToConnectors(h, l, q, v);
                                        break;
                                    case "plotEdges":
                                        G = S.alignToPlotEdges(b, l, q, v);
                                        break;
                                    default:
                                        G = S.radialDistributionX(a,
                                            k, I, u)
                                }
                                b._attr = {
                                    visibility: J,
                                    align: w.alignment
                                };
                                V = k.options.dataLabels || {};
                                b._pos = {
                                    x: G + p(V.x, d.x) + ({
                                        left: n,
                                        right: -n
                                    } [w.alignment] || 0),
                                    y: I + p(V.y, d.y) - 10
                                };
                                w.final.x = G;
                                w.final.y = I;
                                p(d.crop, !0) && (z = b.getBBox().width, u = null, G - z < n && 1 === l ? (u = Math.round(z - G + n), O[3] = Math.max(u, O[3])) : G + z > q - n && 0 === l && (u = Math.round(G + z - q + n), O[1] = Math.max(u, O[1])), 0 > I - E / 2 ? O[0] = Math.max(Math.round(-I + E / 2), O[0]) : I + E / 2 > t && (O[2] = Math.max(Math.round(I + E / 2 - t), O[2])), b.sideOverflow = u)
                            }
                        }
                    }), 0 === D(O) || this.verifyDataLabelOverflow(O)) &&
                    (this.placeDataLabels(), this.points.forEach(function (c) {
                        V = K(d, c.options.dataLabels);
                        if (r = p(V.connectorWidth, 1)) {
                            var e;
                            y = c.connector;
                            if ((b = c.dataLabel) && b._pos && c.visible && 0 < c.labelDistance) {
                                J = b._attr.visibility;
                                if (e = !y) c.connector = y = g.renderer.path().addClass("highcharts-data-label-connector  highcharts-color-" + c.colorIndex + (c.className ? " " + c.className : "")).add(a.dataLabelsGroup), g.styledMode || y.attr({
                                    "stroke-width": r,
                                    stroke: V.connectorColor || c.color || "#666666"
                                });
                                y[e ? "attr" : "animate"]({
                                    d: c.getConnectorPath()
                                });
                                y.attr("visibility", J)
                            } else y && (c.connector = y.destroy())
                        }
                    }))
            }, y.pie.prototype.placeDataLabels = function () {
                this.points.forEach(function (a) {
                    var f = a.dataLabel,
                        h;
                    f && a.visible && ((h = f._pos) ? (f.sideOverflow && (f._attr.width = Math.max(f.getBBox().width - f.sideOverflow, 0), f.css({
                        width: f._attr.width + "px",
                        textOverflow: (this.options.dataLabels.style || {}).textOverflow || "ellipsis"
                    }), f.shortened = !0), f.attr(f._attr), f[f.moved ? "animate" : "attr"](h), f.moved = !0) : f && f.attr({
                        y: -9999
                    }));
                    delete a.distributeBox
                }, this)
            }, y.pie.prototype.alignDataLabel =
            n, y.pie.prototype.verifyDataLabelOverflow = function (a) {
                var f = this.center,
                    h = this.options,
                    g = h.center,
                    d = h.minSize || 80,
                    m = null !== h.size;
                if (!m) {
                    if (null !== g[0]) var n = Math.max(f[2] - Math.max(a[1], a[3]), d);
                    else n = Math.max(f[2] - a[1] - a[3], d), f[0] += (a[3] - a[1]) / 2;
                    null !== g[1] ? n = G(n, d, f[2] - Math.max(a[0], a[2])) : (n = G(n, d, f[2] - a[0] - a[2]), f[1] += (a[0] - a[2]) / 2);
                    n < f[2] ? (f[2] = n, f[3] = Math.min(t(h.innerSize || 0, n), n), this.translate(f), this.drawDataLabels && this.drawDataLabels()) : m = !0
                }
                return m
            });
        y.column && (y.column.prototype.alignDataLabel =
            function (a, f, k, g, d) {
                var h = this.chart.inverted,
                    l = a.series,
                    n = a.dlBox || a.shapeArgs,
                    q = p(a.below, a.plotY > p(this.translatedThreshold, l.yAxis.len)),
                    t = p(k.inside, !!this.options.stacking);
                n && (g = K(n), 0 > g.y && (g.height += g.y, g.y = 0), n = g.y + g.height - l.yAxis.len, 0 < n && n < g.height && (g.height -= n), h && (g = {
                    x: l.yAxis.len - g.y - g.height,
                    y: l.xAxis.len - g.x - g.width,
                    width: g.height,
                    height: g.width
                }), t || (h ? (g.x += q ? 0 : g.width, g.width = 0) : (g.y += q ? g.height : 0, g.height = 0)));
                k.align = p(k.align, !h || t ? "center" : q ? "right" : "left");
                k.verticalAlign =
                    p(k.verticalAlign, h || t ? "middle" : q ? "top" : "bottom");
                m.prototype.alignDataLabel.call(this, a, f, k, g, d);
                k.inside && a.contrastColor && f.css({
                    color: a.contrastColor
                })
            })
    });
    O(n, "Extensions/OverlappingDataLabels.js", [n["Core/Chart/Chart.js"], n["Core/Utilities.js"]], function (f, a) {
        var n = a.addEvent,
            y = a.fireEvent,
            D = a.isArray,
            G = a.isNumber,
            C = a.objectEach,
            J = a.pick;
        n(f, "render", function () {
            var a = [];
            (this.labelCollectors || []).forEach(function (f) {
                a = a.concat(f())
            });
            (this.yAxis || []).forEach(function (f) {
                f.stacking && f.options.stackLabels &&
                    !f.options.stackLabels.allowOverlap && C(f.stacking.stacks, function (f) {
                        C(f, function (f) {
                            a.push(f.label)
                        })
                    })
            });
            (this.series || []).forEach(function (f) {
                var n = f.options.dataLabels;
                f.visible && (!1 !== n.enabled || f._hasPointLabels) && (f.nodes || f.points).forEach(function (f) {
                    f.visible && (D(f.dataLabels) ? f.dataLabels : f.dataLabel ? [f.dataLabel] : []).forEach(function (n) {
                        var q = n.options;
                        n.labelrank = J(q.labelrank, f.labelrank, f.shapeArgs && f.shapeArgs.height);
                        q.allowOverlap || a.push(n)
                    })
                })
            });
            this.hideOverlappingLabels(a)
        });
        f.prototype.hideOverlappingLabels = function (a) {
            var f = this,
                n = a.length,
                q = f.renderer,
                C, E, p, t = !1;
            var D = function (a) {
                var f, h = a.box ? 0 : a.padding || 0,
                    g = f = 0,
                    d;
                if (a && (!a.alignAttr || a.placed)) {
                    var m = a.alignAttr || {
                        x: a.attr("x"),
                        y: a.attr("y")
                    };
                    var n = a.parentGroup;
                    a.width || (f = a.getBBox(), a.width = f.width, a.height = f.height, f = q.fontMetrics(null, a.element).h);
                    var p = a.width - 2 * h;
                    (d = {
                        left: "0",
                        center: "0.5",
                        right: "1"
                    } [a.alignValue]) ? g = +d * p: G(a.x) && Math.round(a.x) !== a.translateX && (g = a.x - a.translateX);
                    return {
                        x: m.x + (n.translateX ||
                            0) + h - (g || 0),
                        y: m.y + (n.translateY || 0) + h - f,
                        width: a.width - 2 * h,
                        height: a.height - 2 * h
                    }
                }
            };
            for (E = 0; E < n; E++)
                if (C = a[E]) C.oldOpacity = C.opacity, C.newOpacity = 1, C.absoluteBox = D(C);
            a.sort(function (a, f) {
                return (f.labelrank || 0) - (a.labelrank || 0)
            });
            for (E = 0; E < n; E++) {
                var u = (D = a[E]) && D.absoluteBox;
                for (C = E + 1; C < n; ++C) {
                    var m = (p = a[C]) && p.absoluteBox;
                    !u || !m || D === p || 0 === D.newOpacity || 0 === p.newOpacity || m.x >= u.x + u.width || m.x + m.width <= u.x || m.y >= u.y + u.height || m.y + m.height <= u.y || ((D.labelrank < p.labelrank ? D : p).newOpacity = 0)
                }
            }
            a.forEach(function (a) {
                if (a) {
                    var h =
                        a.newOpacity;
                    a.oldOpacity !== h && (a.alignAttr && a.placed ? (a[h ? "removeClass" : "addClass"]("highcharts-data-label-hidden"), t = !0, a.alignAttr.opacity = h, a[a.isOld ? "animate" : "attr"](a.alignAttr, null, function () {
                        f.styledMode || a.css({
                            pointerEvents: h ? "auto" : "none"
                        });
                        a.visibility = h ? "inherit" : "hidden"
                    }), y(f, "afterHideOverlappingLabel")) : a.attr({
                        opacity: h
                    }));
                    a.isOld = !0
                }
            });
            t && y(f, "afterHideAllOverlappingLabels")
        }
    });
    O(n, "Core/Interaction.js", [n["Core/Chart/Chart.js"], n["Core/Globals.js"], n["Core/Legend.js"], n["Core/Options.js"],
        n["Core/Series/Point.js"], n["Core/Utilities.js"]
    ], function (f, a, n, y, D, G) {
        var C = y.defaultOptions,
            J = G.addEvent,
            H = G.createElement,
            v = G.css,
            L = G.defined,
            q = G.extend,
            K = G.fireEvent,
            E = G.isArray,
            p = G.isFunction,
            t = G.isNumber,
            I = G.isObject,
            u = G.merge,
            m = G.objectEach,
            h = G.pick,
            l = a.hasTouch;
        y = a.Series;
        G = a.seriesTypes;
        var k = a.svg;
        var g = a.TrackerMixin = {
            drawTrackerPoint: function () {
                var a = this,
                    f = a.chart,
                    g = f.pointer,
                    h = function (a) {
                        var d = g.getPointFromEvent(a);
                        "undefined" !== typeof d && (g.isDirectTouch = !0, d.onMouseOver(a))
                    },
                    k;
                a.points.forEach(function (a) {
                    k = E(a.dataLabels) ? a.dataLabels : a.dataLabel ? [a.dataLabel] : [];
                    a.graphic && (a.graphic.element.point = a);
                    k.forEach(function (d) {
                        d.div ? d.div.point = a : d.element.point = a
                    })
                });
                a._hasTracking || (a.trackerGroups.forEach(function (d) {
                    if (a[d]) {
                        a[d].addClass("highcharts-tracker").on("mouseover", h).on("mouseout", function (a) {
                            g.onTrackerMouseOut(a)
                        });
                        if (l) a[d].on("touchstart", h);
                        !f.styledMode && a.options.cursor && a[d].css(v).css({
                            cursor: a.options.cursor
                        })
                    }
                }), a._hasTracking = !0);
                K(this, "afterDrawTracker")
            },
            drawTrackerGraph: function () {
                var a = this,
                    f = a.options,
                    g = f.trackByArea,
                    h = [].concat(g ? a.areaPath : a.graphPath),
                    m = a.chart,
                    n = m.pointer,
                    p = m.renderer,
                    q = m.options.tooltip.snap,
                    t = a.tracker,
                    e = function (b) {
                        if (m.hoverSeries !== a) a.onMouseOver()
                    },
                    c = "rgba(192,192,192," + (k ? .0001 : .002) + ")";
                t ? t.attr({
                    d: h
                }) : a.graph && (a.tracker = p.path(h).attr({
                    visibility: a.visible ? "visible" : "hidden",
                    zIndex: 2
                }).addClass(g ? "highcharts-tracker-area" : "highcharts-tracker-line").add(a.group), m.styledMode || a.tracker.attr({
                    "stroke-linecap": "round",
                    "stroke-linejoin": "round",
                    stroke: c,
                    fill: g ? c : "none",
                    "stroke-width": a.graph.strokeWidth() + (g ? 0 : 2 * q)
                }), [a.tracker, a.markerGroup].forEach(function (a) {
                    a.addClass("highcharts-tracker").on("mouseover", e).on("mouseout", function (a) {
                        n.onTrackerMouseOut(a)
                    });
                    f.cursor && !m.styledMode && a.css({
                        cursor: f.cursor
                    });
                    if (l) a.on("touchstart", e)
                }));
                K(this, "afterDrawTracker")
            }
        };
        G.column && (G.column.prototype.drawTracker = g.drawTrackerPoint);
        G.pie && (G.pie.prototype.drawTracker = g.drawTrackerPoint);
        G.scatter && (G.scatter.prototype.drawTracker =
            g.drawTrackerPoint);
        q(n.prototype, {
            setItemEvents: function (a, f, g) {
                var d = this,
                    h = d.chart.renderer.boxWrapper,
                    k = a instanceof D,
                    l = "highcharts-legend-" + (k ? "point" : "series") + "-active",
                    m = d.chart.styledMode;
                (g ? [f, a.legendSymbol] : [a.legendGroup]).forEach(function (g) {
                    if (g) g.on("mouseover", function () {
                        a.visible && d.allItems.forEach(function (d) {
                            a !== d && d.setState("inactive", !k)
                        });
                        a.setState("hover");
                        a.visible && h.addClass(l);
                        m || f.css(d.options.itemHoverStyle)
                    }).on("mouseout", function () {
                        d.chart.styledMode || f.css(u(a.visible ?
                            d.itemStyle : d.itemHiddenStyle));
                        d.allItems.forEach(function (d) {
                            a !== d && d.setState("", !k)
                        });
                        h.removeClass(l);
                        a.setState()
                    }).on("click", function (e) {
                        var c = function () {
                            a.setVisible && a.setVisible();
                            d.allItems.forEach(function (b) {
                                a !== b && b.setState(a.visible ? "inactive" : "", !k)
                            })
                        };
                        h.removeClass(l);
                        e = {
                            browserEvent: e
                        };
                        a.firePointEvent ? a.firePointEvent("legendItemClick", e, c) : K(a, "legendItemClick", e, c)
                    })
                })
            },
            createCheckboxForItem: function (a) {
                a.checkbox = H("input", {
                    type: "checkbox",
                    className: "highcharts-legend-checkbox",
                    checked: a.selected,
                    defaultChecked: a.selected
                }, this.options.itemCheckboxStyle, this.chart.container);
                J(a.checkbox, "click", function (d) {
                    K(a.series || a, "checkboxClick", {
                        checked: d.target.checked,
                        item: a
                    }, function () {
                        a.select()
                    })
                })
            }
        });
        q(f.prototype, {
            showResetZoom: function () {
                function a() {
                    f.zoomOut()
                }
                var f = this,
                    g = C.lang,
                    h = f.options.chart.resetZoomButton,
                    k = h.theme,
                    l = k.states,
                    m = "chart" === h.relativeTo || "spaceBox" === h.relativeTo ? null : "plotBox";
                K(this, "beforeShowResetZoom", null, function () {
                    f.resetZoomButton = f.renderer.button(g.resetZoom,
                        null, null, a, k, l && l.hover).attr({
                        align: h.position.align,
                        title: g.resetZoomTitle
                    }).addClass("highcharts-reset-zoom").add().align(h.position, !1, m)
                });
                K(this, "afterShowResetZoom")
            },
            zoomOut: function () {
                K(this, "selection", {
                    resetSelection: !0
                }, this.zoom)
            },
            zoom: function (a) {
                var d = this,
                    f, g = d.pointer,
                    k = !1,
                    l = d.inverted ? g.mouseDownX : g.mouseDownY;
                !a || a.resetSelection ? (d.axes.forEach(function (a) {
                    f = a.zoom()
                }), g.initiated = !1) : a.xAxis.concat(a.yAxis).forEach(function (a) {
                    var h = a.axis,
                        e = d.inverted ? h.left : h.top,
                        c = d.inverted ?
                        e + h.width : e + h.height,
                        b = h.isXAxis,
                        m = !1;
                    if (!b && l >= e && l <= c || b || !L(l)) m = !0;
                    g[b ? "zoomX" : "zoomY"] && m && (f = h.zoom(a.min, a.max), h.displayBtn && (k = !0))
                });
                var m = d.resetZoomButton;
                k && !m ? d.showResetZoom() : !k && I(m) && (d.resetZoomButton = m.destroy());
                f && d.redraw(h(d.options.chart.animation, a && a.animation, 100 > d.pointCount))
            },
            pan: function (d, f) {
                var g = this,
                    h = g.hoverPoints,
                    k = g.options.chart,
                    l = g.options.mapNavigation && g.options.mapNavigation.enabled,
                    m;
                f = "object" === typeof f ? f : {
                    enabled: f,
                    type: "x"
                };
                k && k.panning && (k.panning =
                    f);
                var n = f.type;
                K(this, "pan", {
                    originalEvent: d
                }, function () {
                    h && h.forEach(function (a) {
                        a.setState()
                    });
                    var f = [1];
                    "xy" === n ? f = [1, 0] : "y" === n && (f = [0]);
                    f.forEach(function (e) {
                        var c = g[e ? "xAxis" : "yAxis"][0],
                            b = c.horiz,
                            f = d[b ? "chartX" : "chartY"];
                        b = b ? "mouseDownX" : "mouseDownY";
                        var h = g[b],
                            k = (c.pointRange || 0) / 2,
                            p = c.reversed && !g.inverted || !c.reversed && g.inverted ? -1 : 1,
                            q = c.getExtremes(),
                            r = c.toValue(h - f, !0) + k * p;
                        p = c.toValue(h + c.len - f, !0) - k * p;
                        var u = p < r;
                        h = u ? p : r;
                        r = u ? r : p;
                        var v = c.hasVerticalPanning(),
                            x = c.panningState;
                        c.series.forEach(function (a) {
                            if (v &&
                                !e && (!x || x.isDirty)) {
                                var b = a.getProcessedData(!0);
                                a = a.getExtremes(b.yData, !0);
                                x || (x = {
                                    startMin: Number.MAX_VALUE,
                                    startMax: -Number.MAX_VALUE
                                });
                                t(a.dataMin) && t(a.dataMax) && (x.startMin = Math.min(a.dataMin, x.startMin), x.startMax = Math.max(a.dataMax, x.startMax))
                            }
                        });
                        p = Math.min(a.pick(null === x || void 0 === x ? void 0 : x.startMin, q.dataMin), k ? q.min : c.toValue(c.toPixels(q.min) - c.minPixelPadding));
                        k = Math.max(a.pick(null === x || void 0 === x ? void 0 : x.startMax, q.dataMax), k ? q.max : c.toValue(c.toPixels(q.max) + c.minPixelPadding));
                        c.panningState = x;
                        c.isOrdinal || (u = p - h, 0 < u && (r += u, h = p), u = r - k, 0 < u && (r = k, h -= u), c.series.length && h !== q.min && r !== q.max && h >= p && r <= k && (c.setExtremes(h, r, !1, !1, {
                            trigger: "pan"
                        }), g.resetZoomButton || l || h === p || r === k || !n.match("y") || (g.showResetZoom(), c.displayBtn = !1), m = !0), g[b] = f)
                    });
                    m && g.redraw(!1);
                    v(g.container, {
                        cursor: "move"
                    })
                })
            }
        });
        q(D.prototype, {
            select: function (a, f) {
                var d = this,
                    g = d.series,
                    k = g.chart;
                this.selectedStaging = a = h(a, !d.selected);
                d.firePointEvent(a ? "select" : "unselect", {
                    accumulate: f
                }, function () {
                    d.selected =
                        d.options.selected = a;
                    g.options.data[g.data.indexOf(d)] = d.options;
                    d.setState(a && "select");
                    f || k.getSelectedPoints().forEach(function (a) {
                        var f = a.series;
                        a.selected && a !== d && (a.selected = a.options.selected = !1, f.options.data[f.data.indexOf(a)] = a.options, a.setState(k.hoverPoints && f.options.inactiveOtherPoints ? "inactive" : ""), a.firePointEvent("unselect"))
                    })
                });
                delete this.selectedStaging
            },
            onMouseOver: function (a) {
                var d = this.series.chart,
                    f = d.pointer;
                a = a ? f.normalize(a) : f.getChartCoordinatesFromPoint(this, d.inverted);
                f.runPointActions(a, this)
            },
            onMouseOut: function () {
                var a = this.series.chart;
                this.firePointEvent("mouseOut");
                this.series.options.inactiveOtherPoints || (a.hoverPoints || []).forEach(function (a) {
                    a.setState()
                });
                a.hoverPoints = a.hoverPoint = null
            },
            importEvents: function () {
                if (!this.hasImportedEvents) {
                    var a = this,
                        f = u(a.series.options.point, a.options).events;
                    a.events = f;
                    m(f, function (d, f) {
                        p(d) && J(a, f, d)
                    });
                    this.hasImportedEvents = !0
                }
            },
            setState: function (a, f) {
                var d = this.series,
                    g = this.state,
                    k = d.options.states[a || "normal"] || {},
                    l = C.plotOptions[d.type].marker && d.options.marker,
                    m = l && !1 === l.enabled,
                    n = l && l.states && l.states[a || "normal"] || {},
                    p = !1 === n.enabled,
                    e = d.stateMarkerGraphic,
                    c = this.marker || {},
                    b = d.chart,
                    t = d.halo,
                    u, v = l && d.markerAttribs;
                a = a || "";
                if (!(a === this.state && !f || this.selected && "select" !== a || !1 === k.enabled || a && (p || m && !1 === n.enabled) || a && c.states && c.states[a] && !1 === c.states[a].enabled)) {
                    this.state = a;
                    v && (u = d.markerAttribs(this, a));
                    if (this.graphic) {
                        g && this.graphic.removeClass("highcharts-point-" + g);
                        a && this.graphic.addClass("highcharts-point-" +
                            a);
                        if (!b.styledMode) {
                            var x = d.pointAttribs(this, a);
                            var y = h(b.options.chart.animation, k.animation);
                            d.options.inactiveOtherPoints && x.opacity && ((this.dataLabels || []).forEach(function (a) {
                                a && a.animate({
                                    opacity: x.opacity
                                }, y)
                            }), this.connector && this.connector.animate({
                                opacity: x.opacity
                            }, y));
                            this.graphic.animate(x, y)
                        }
                        u && this.graphic.animate(u, h(b.options.chart.animation, n.animation, l.animation));
                        e && e.hide()
                    } else {
                        if (a && n) {
                            g = c.symbol || d.symbol;
                            e && e.currentSymbol !== g && (e = e.destroy());
                            if (u)
                                if (e) e[f ? "animate" : "attr"]({
                                    x: u.x,
                                    y: u.y
                                });
                                else g && (d.stateMarkerGraphic = e = b.renderer.symbol(g, u.x, u.y, u.width, u.height).add(d.markerGroup), e.currentSymbol = g);
                            !b.styledMode && e && e.attr(d.pointAttribs(this, a))
                        }
                        e && (e[a && this.isInside ? "show" : "hide"](), e.element.point = this)
                    }
                    a = k.halo;
                    k = (e = this.graphic || e) && e.visibility || "inherit";
                    a && a.size && e && "hidden" !== k && !this.isCluster ? (t || (d.halo = t = b.renderer.path().add(e.parentGroup)), t.show()[f ? "animate" : "attr"]({
                        d: this.haloPath(a.size)
                    }), t.attr({
                        "class": "highcharts-halo highcharts-color-" + h(this.colorIndex,
                            d.colorIndex) + (this.className ? " " + this.className : ""),
                        visibility: k,
                        zIndex: -1
                    }), t.point = this, b.styledMode || t.attr(q({
                        fill: this.color || d.color,
                        "fill-opacity": a.opacity
                    }, a.attributes))) : t && t.point && t.point.haloPath && t.animate({
                        d: t.point.haloPath(0)
                    }, null, t.hide);
                    K(this, "afterSetState")
                }
            },
            haloPath: function (a) {
                return this.series.chart.renderer.symbols.circle(Math.floor(this.plotX) - a, this.plotY - a, 2 * a, 2 * a)
            }
        });
        q(y.prototype, {
            onMouseOver: function () {
                var a = this.chart,
                    f = a.hoverSeries;
                a.pointer.setHoverChartIndex();
                if (f && f !== this) f.onMouseOut();
                this.options.events.mouseOver && K(this, "mouseOver");
                this.setState("hover");
                a.hoverSeries = this
            },
            onMouseOut: function () {
                var a = this.options,
                    f = this.chart,
                    g = f.tooltip,
                    h = f.hoverPoint;
                f.hoverSeries = null;
                if (h) h.onMouseOut();
                this && a.events.mouseOut && K(this, "mouseOut");
                !g || this.stickyTracking || g.shared && !this.noSharedTooltip || g.hide();
                f.series.forEach(function (a) {
                    a.setState("", !0)
                })
            },
            setState: function (a, f) {
                var d = this,
                    g = d.options,
                    k = d.graph,
                    l = g.inactiveOtherPoints,
                    m = g.states,
                    n = g.lineWidth,
                    p = g.opacity,
                    e = h(m[a || "normal"] && m[a || "normal"].animation, d.chart.options.chart.animation);
                g = 0;
                a = a || "";
                if (d.state !== a && ([d.group, d.markerGroup, d.dataLabelsGroup].forEach(function (c) {
                        c && (d.state && c.removeClass("highcharts-series-" + d.state), a && c.addClass("highcharts-series-" + a))
                    }), d.state = a, !d.chart.styledMode)) {
                    if (m[a] && !1 === m[a].enabled) return;
                    a && (n = m[a].lineWidth || n + (m[a].lineWidthPlus || 0), p = h(m[a].opacity, p));
                    if (k && !k.dashstyle)
                        for (m = {
                                "stroke-width": n
                            }, k.animate(m, e); d["zone-graph-" + g];) d["zone-graph-" +
                            g].attr(m), g += 1;
                    l || [d.group, d.markerGroup, d.dataLabelsGroup, d.labelBySeries].forEach(function (a) {
                        a && a.animate({
                            opacity: p
                        }, e)
                    })
                }
                f && l && d.points && d.setAllPointsToState(a)
            },
            setAllPointsToState: function (a) {
                this.points.forEach(function (d) {
                    d.setState && d.setState(a)
                })
            },
            setVisible: function (a, f) {
                var d = this,
                    g = d.chart,
                    h = d.legendItem,
                    k = g.options.chart.ignoreHiddenSeries,
                    l = d.visible;
                var m = (d.visible = a = d.options.visible = d.userOptions.visible = "undefined" === typeof a ? !l : a) ? "show" : "hide";
                ["group", "dataLabelsGroup",
                    "markerGroup", "tracker", "tt"
                ].forEach(function (a) {
                    if (d[a]) d[a][m]()
                });
                if (g.hoverSeries === d || (g.hoverPoint && g.hoverPoint.series) === d) d.onMouseOut();
                h && g.legend.colorizeItem(d, a);
                d.isDirty = !0;
                d.options.stacking && g.series.forEach(function (a) {
                    a.options.stacking && a.visible && (a.isDirty = !0)
                });
                d.linkedSeries.forEach(function (d) {
                    d.setVisible(a, !1)
                });
                k && (g.isDirtyBox = !0);
                K(d, m);
                !1 !== f && g.redraw()
            },
            show: function () {
                this.setVisible(!0)
            },
            hide: function () {
                this.setVisible(!1)
            },
            select: function (a) {
                this.selected = a = this.options.selected =
                    "undefined" === typeof a ? !this.selected : a;
                this.checkbox && (this.checkbox.checked = a);
                K(this, a ? "select" : "unselect")
            },
            drawTracker: g.drawTrackerGraph
        })
    });
    O(n, "Core/Responsive.js", [n["Core/Chart/Chart.js"], n["Core/Utilities.js"]], function (f, a) {
        var n = a.find,
            y = a.isArray,
            D = a.isObject,
            G = a.merge,
            C = a.objectEach,
            J = a.pick,
            H = a.splat,
            v = a.uniqueKey;
        f.prototype.setResponsive = function (a, f) {
            var q = this.options.responsive,
                y = [],
                p = this.currentResponsive;
            !f && q && q.rules && q.rules.forEach(function (a) {
                "undefined" === typeof a._id &&
                    (a._id = v());
                this.matchResponsiveRule(a, y)
            }, this);
            f = G.apply(0, y.map(function (a) {
                return n(q.rules, function (f) {
                    return f._id === a
                }).chartOptions
            }));
            f.isResponsiveOptions = !0;
            y = y.toString() || void 0;
            y !== (p && p.ruleIds) && (p && this.update(p.undoOptions, a, !0), y ? (p = this.currentOptions(f), p.isResponsiveOptions = !0, this.currentResponsive = {
                ruleIds: y,
                mergedOptions: f,
                undoOptions: p
            }, this.update(f, a, !0)) : this.currentResponsive = void 0)
        };
        f.prototype.matchResponsiveRule = function (a, f) {
            var n = a.condition;
            (n.callback || function () {
                return this.chartWidth <=
                    J(n.maxWidth, Number.MAX_VALUE) && this.chartHeight <= J(n.maxHeight, Number.MAX_VALUE) && this.chartWidth >= J(n.minWidth, 0) && this.chartHeight >= J(n.minHeight, 0)
            }).call(this) && f.push(a._id)
        };
        f.prototype.currentOptions = function (a) {
            function f(a, q, v, u) {
                var m;
                C(a, function (a, l) {
                    if (!u && -1 < n.collectionsWithUpdate.indexOf(l))
                        for (a = H(a), v[l] = [], m = 0; m < Math.max(a.length, q[l].length); m++) q[l][m] && (void 0 === a[m] ? v[l][m] = q[l][m] : (v[l][m] = {}, f(a[m], q[l][m], v[l][m], u + 1)));
                    else D(a) ? (v[l] = y(a) ? [] : {}, f(a, q[l] || {}, v[l], u + 1)) :
                        v[l] = "undefined" === typeof q[l] ? null : q[l]
                })
            }
            var n = this,
                v = {};
            f(a, this.options, v, 0);
            return v
        }
    });
    O(n, "masters/highcharts.src.js", [n["Core/Globals.js"]], function (f) {
        return f
    });
    n["masters/highcharts.src.js"]._modules = n;
    return n["masters/highcharts.src.js"]
});
//# sourceMappingURL=highcharts.js.map