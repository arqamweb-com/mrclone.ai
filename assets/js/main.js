/**
 * MrClone.AI front-end behaviour.
 * Settings (form endpoint, WhatsApp number) come from the Customizer via
 * wp_localize_script → window.MRCLONE.
 */
var MRCLONE = window.MRCLONE || {};
/* An external webhook (Customizer) wins; otherwise the WordPress endpoint. */
var FORM_ENDPOINT = MRCLONE.formEndpoint || MRCLONE.applyUrl || "";
var WHATSAPP = MRCLONE.whatsapp || "971528160620";
(function () {
  var root = document.documentElement;
  root.classList.add("js");
  var reduce = window.matchMedia("(prefers-reduced-motion: reduce)").matches;

  /* Reveal: only blocks that start below the fold get the lift. */
  var rv = [].slice.call(document.querySelectorAll(".rv"));
  if ("IntersectionObserver" in window && !reduce) {
    var io = new IntersectionObserver(function (es) {
      es.forEach(function (e) { if (e.isIntersecting) { e.target.classList.remove("pre"); io.unobserve(e.target); } });
    }, { rootMargin: "0px 0px -8% 0px" });
    rv.forEach(function (el) {
      if (el.getBoundingClientRect().top > window.innerHeight) { el.classList.add("pre"); io.observe(el); }
    });
  }

  /* Hero film: grows to full width as you scroll, Apple style. */
  var frame = document.getElementById("filmFrame");
  var stmt = document.getElementById("statement");
  var words = [];
  if (stmt) {
    var hl = ["bottleneck.", "Twin", "keeps", "going."];
    stmt.innerHTML = stmt.textContent.trim().split(/\s+/).map(function (w) {
      return '<span class="w' + (hl.indexOf(w) > -1 ? " hl" : "") + '">' + w + "</span>";
    }).join(" ");
    words = [].slice.call(stmt.querySelectorAll(".w"));
    if (reduce) words.forEach(function (w) { w.classList.add("on"); });
  }
  var ticking = false;
  function onScroll() {
    if (ticking) return; ticking = true;
    requestAnimationFrame(function () {
      ticking = false;
      var vh = window.innerHeight;
      if (frame && !reduce && window.innerWidth > 760) {
        var r = frame.parentNode.getBoundingClientRect();
        var p = Math.min(1, Math.max(0, (vh - r.top) / (vh * 0.9)));
        var s = 0.86 + 0.14 * p;
        frame.style.transform = "scale(" + s.toFixed(4) + ")";
        frame.style.borderRadius = (28 - 14 * p).toFixed(1) + "px";
      }
      if (words.length && !reduce) {
        var sr = stmt.getBoundingClientRect();
        var prog = (vh * 0.85 - sr.top) / (sr.height + vh * 0.35);
        var lit = Math.round(Math.min(1, Math.max(0, prog)) * words.length);
        words.forEach(function (w, i) { w.classList.toggle("on", i < lit); });
      }
    });
  }
  window.addEventListener("scroll", onScroll, { passive: true });
  window.addEventListener("resize", onScroll);
  onScroll();

  /* Hero controls */
  var hv = document.getElementById("heroVideo");
  var soundBtn = document.getElementById("soundBtn");
  var soundLabel = document.getElementById("soundLabel");
  var wave = document.getElementById("soundWave");
  var pauseBtn = document.getElementById("pauseBtn");
  var pauseIcon = document.getElementById("pauseIcon");
  function setSound(on) {
    hv.muted = !on;
    soundBtn.setAttribute("aria-pressed", on ? "true" : "false");
    soundLabel.textContent = on ? "Sound off" : "Sound on";
    wave.setAttribute("d", on ? "M15.5 8.5a5 5 0 0 1 0 7M19 5a10 10 0 0 1 0 14" : "M23 9l-6 6M17 9l6 6");
  }
  function setPlaying(on) {
    pauseIcon.setAttribute("d", on ? "M7 5h3.5v14H7zM13.5 5H17v14h-3.5z" : "M7 4l13 8-13 8z");
    pauseBtn.setAttribute("aria-label", on ? "Pause film" : "Play film");
  }
  if (hv) {
    if (reduce) { hv.removeAttribute("autoplay"); hv.pause(); }
    soundBtn.addEventListener("click", function () {
      var on = hv.muted;
      if (on) { hv.currentTime = 0; hv.play().catch(function () {}); }
      setSound(on);
    });
    pauseBtn.addEventListener("click", function () { hv.paused ? hv.play().catch(function () {}) : hv.pause(); });
    hv.addEventListener("play", function () { setPlaying(true); });
    hv.addEventListener("pause", function () { setPlaying(false); });
    setPlaying(!hv.paused);
    /* Sound on with the visitor's first tap, click or key press (browsers
       never allow sound before that). Only while the film is on screen. */
    soundLabel.textContent = "Tap for sound";
    var firstTouch = function (e) {
      ["pointerdown", "keydown", "touchend"].forEach(function (t) { window.removeEventListener(t, firstTouch, true); });
      if (e.target && e.target.closest && e.target.closest(".reel, #soundBtn, #pauseBtn")) return;
      var r = hv.getBoundingClientRect();
      if (hv.muted && r.bottom > 0 && r.top < window.innerHeight) {
        setSound(true);
        if (hv.paused) hv.play().catch(function () {});
      }
    };
    ["pointerdown", "keydown", "touchend"].forEach(function (t) { window.addEventListener(t, firstTouch, true); });
    document.getElementById("watchLink").addEventListener("click", function () {
      hv.currentTime = 0; setSound(true); hv.play().catch(function () {});
    });
  }

  /* Work players: click to play with sound; only one plays at a time. */
  var reels = [].slice.call(document.querySelectorAll(".reel"));
  reels.forEach(function (fig) {
    var v = fig.querySelector("video"), b = fig.querySelector(".play");
    b.addEventListener("click", function () {
      reels.forEach(function (o) { var ov = o.querySelector("video"); if (ov !== v) ov.pause(); });
      if (hv && !hv.muted) setSound(false);
      films.forEach(function (f) { if (!f.muted) { f.muted = true; syncBtn(f); } });
      v.controls = true; b.hidden = true; v.play().catch(function () {});
    });
    v.addEventListener("play", function () {
      reels.forEach(function (o) { var ov = o.querySelector("video"); if (ov !== v) ov.pause(); });
      if (hv && !hv.muted) setSound(false);
    });
  });


  /* Vertical films: play muted while on screen; one sound source at a time. */
  var allVids = [].slice.call(document.querySelectorAll("video"));
  function muteOthers(keep) {
    allVids.forEach(function (v) { if (v !== keep && !v.muted) { v.muted = true; syncBtn(v); } });
    if (keep !== hv && hv && !hv.muted) setSound(false);
  }
  function syncBtn(v) {
    var b = v.parentNode.querySelector(".snd"); if (!b) return;
    b.setAttribute("aria-pressed", v.muted ? "false" : "true");
    b.querySelector("span").textContent = v.muted ? "Sound on" : "Sound off";
    b.querySelector(".wv").setAttribute("d", v.muted ? "M23 9l-6 6M17 9l6 6" : "M15.5 8.5a5 5 0 0 1 0 7M19 5a10 10 0 0 1 0 14");
  }
  var films = [].slice.call(document.querySelectorAll("video[data-inview]"));
  if ("IntersectionObserver" in window) {
    var vo = new IntersectionObserver(function (es) {
      es.forEach(function (e) {
        var v = e.target;
        if (e.isIntersecting) { if (!reduce || !v.muted) { v.preload = "auto"; v.play().catch(function () {}); } }
        else { v.pause(); if (!v.muted) { v.muted = true; syncBtn(v); } }
      });
    }, { threshold: 0.35 });
    films.forEach(function (v) { vo.observe(v); });
  }
  films.forEach(function (v) {
    var b = v.parentNode.querySelector(".snd");
    b.addEventListener("click", function () {
      if (v.muted) { muteOthers(v); v.muted = false; v.currentTime = 0; v.play().catch(function () {}); }
      else { v.muted = true; }
      syncBtn(v);
    });
  });
  if (hv) hv.addEventListener("volumechange", function () { if (!hv.muted) films.forEach(function (v) { if (!v.muted) { v.muted = true; syncBtn(v); } }); });

  /* Language carousel */
  var langs = [].slice.call(document.querySelectorAll(".lang-stage span"));
  var chips = [].slice.call(document.querySelectorAll(".lang-list li"));
  var li = 0;
  if (langs.length && !reduce) {
    setInterval(function () {
      var cur = langs[li]; cur.classList.remove("on"); cur.classList.add("out");
      chips[li].classList.remove("on");
      setTimeout(function () { cur.classList.remove("out"); }, 700);
      li = (li + 1) % langs.length;
      langs[li].classList.add("on"); chips[li].classList.add("on");
    }, 2200);
  }

  /* Plan buttons preselect the plan in the form */
  [].slice.call(document.querySelectorAll("[data-plan]")).forEach(function (a) {
    a.addEventListener("click", function () {
      var p = a.getAttribute("data-plan");
      var el = p === "twin" ? document.getElementById("p-twin") : p === "sprint" ? document.getElementById("p-sprint") : null;
      if (el) el.checked = true;
    });
  });

  /* Application form */
  var form = document.getElementById("applyForm");
  var err = document.getElementById("formError");
  var done = document.getElementById("done");
  form.addEventListener("submit", function (e) {
    e.preventDefault();
    err.hidden = true;
    var bad = [];
    [].slice.call(form.querySelectorAll("[required]")).forEach(function (f) {
      var ok = f.value.trim() !== "" && (f.type !== "email" || /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(f.value.trim()));
      f.setAttribute("aria-invalid", ok ? "false" : "true");
      if (!ok) bad.push(f);
    });
    if (bad.length) {
      err.textContent = "Please fill in the highlighted fields so we can review your application.";
      err.hidden = false; bad[0].focus(); return;
    }
    var d = new FormData(form);
    var data = {};
    d.forEach(function (v, k) { data[k] = v; });
    data.plan = data.plan || "Not sure yet";
    var msg = "New MrClone.AI application\n\n" +
      "Name: " + data.name + "\nEmail: " + data.email + "\nWhatsApp: " + data.whatsapp +
      "\nInstagram / site: " + data.link + "\nPlan: " + data.plan + "\nAudience: " + data.audience +
      "\nBudget: " + data.budget + "\nStart: " + data.start + (data.goal ? "\nGoal: " + data.goal : "");
    document.getElementById("waSend").href = "https://wa.me/" + WHATSAPP + "?text=" + encodeURIComponent(msg);

    function showDone(sent) {
      if (sent) {
        document.getElementById("doneTitle").textContent = "Application received.";
        document.getElementById("doneText").textContent = "Thank you, " + data.name.split(" ")[0] + ". We read every application personally and reply within 24 hours if we're a fit. Want a faster answer? Send it on WhatsApp too.";
      }
      form.hidden = true; done.hidden = false; done.focus();
    }
    if (FORM_ENDPOINT) {
      var btn = document.getElementById("submitBtn");
      btn.disabled = true; btn.textContent = "Sending…";
      fetch(FORM_ENDPOINT, { method: "POST", headers: { "Content-Type": "application/json", "Accept": "application/json" }, body: JSON.stringify(data) })
        .then(function (r) { if (!r.ok) throw r; showDone(true); })
        .catch(function () {
          btn.disabled = false; btn.textContent = "Send application";
          err.textContent = "Your application didn't send. Check your connection and try again, or send it on WhatsApp below.";
          err.hidden = false; showDone(false);
        });
    } else {
      showDone(false);
    }
  });
})();
