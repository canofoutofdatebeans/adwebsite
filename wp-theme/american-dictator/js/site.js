/* American Dictator site interactions. Vanilla JS, no dependencies, no data collected. */
(function () {
  'use strict';

  var reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

  /* ----- Official banner ----- */
  var govHow = document.getElementById('govHow');
  var govAnswer = document.getElementById('govAnswer');
  if (govHow) govHow.addEventListener('click', function () {
    govAnswer.hidden = !govAnswer.hidden;
    govHow.textContent = govAnswer.hidden ? "Here's how you know" : 'Understood, sir';
  });

  /* ----- Sticky nav shadow ----- */
  var nav = document.getElementById('nav');
  window.addEventListener('scroll', function () {
    nav.classList.toggle('scrolled', window.scrollY > 10);
  }, { passive: true });

  /* ----- Reveal on scroll ----- */
  var revealEls = document.querySelectorAll('.reveal');
  if ('IntersectionObserver' in window && !reduceMotion) {
    var io = new IntersectionObserver(function (entries) {
      entries.forEach(function (e) {
        if (e.isIntersecting) { e.target.classList.add('in'); io.unobserve(e.target); }
      });
    }, { threshold: 0.12 });
    revealEls.forEach(function (el) { io.observe(el); });
  } else {
    revealEls.forEach(function (el) { el.classList.add('in'); });
  }

  /* ----- Ticker: duplicate content for a seamless loop ----- */
  var tickerInner = document.getElementById('tickerInner');
  if (tickerInner) tickerInner.innerHTML += tickerInner.innerHTML;

  /* ----- Count-up stats ----- */
  function countUp(el, target, suffix, ms) {
    if (reduceMotion) { el.textContent = target + suffix; return; }
    var start = null;
    function step(t) {
      if (!start) start = t;
      var p = Math.min((t - start) / ms, 1);
      var eased = 1 - Math.pow(1 - p, 3);
      el.textContent = Math.round(target * eased) + suffix;
      if (p < 1) requestAnimationFrame(step);
    }
    requestAnimationFrame(step);
  }
  var statApproval = document.getElementById('statApproval');
  var statCrises = document.getElementById('statCrises');
  var statsRun = false;
  function runStats() {
    if (statsRun) return;
    statsRun = true;
    countUp(statApproval, 143, '%', 2200);
    countUp(statCrises, 342, '', 2200);
    // The approval rating continues to improve while observed.
    if (!reduceMotion) setInterval(function () {
      var v = parseInt(statApproval.textContent, 10);
      if (v >= 143 && v < 199 && Math.random() < 0.4) statApproval.textContent = (v + 1) + '%';
    }, 4000);
  }
  if ('IntersectionObserver' in window) {
    var sio = new IntersectionObserver(function (entries) {
      if (entries[0].isIntersecting) { runStats(); sio.disconnect(); }
    });
    sio.observe(statApproval);
  } else { runStats(); }

  /* ----- Toast ----- */
  var toastEl = document.getElementById('toast');
  var toastTimer = null;
  function toast(msg) {
    toastEl.textContent = msg;
    toastEl.classList.add('show');
    clearTimeout(toastTimer);
    toastTimer = setTimeout(function () { toastEl.classList.remove('show'); }, 3600);
  }

  /* ----- Tribute register (the cart) ----- */
  var cartCount = document.getElementById('cartCount');
  var cartBadge = document.getElementById('cartBadge');
  var tributes = 0;
  var tributeLines = [
    'Your tribute has been recorded.',
    'The Treasury thanks you. The Treasury is us.',
    'Shipping is unavailable. The item remains the property of the President.',
    'Payment failed successfully. Your loyalty has been charged instead.',
    'Receipt withheld for national security reasons.',
    'You are now a Founding Patriot (tier: Bronze, non-refundable).'
  ];
  document.querySelectorAll('.add-btn').forEach(function (btn) {
    btn.addEventListener('click', function () {
      tributes += 1;
      cartCount.textContent = tributes;
      cartBadge.classList.remove('bump');
      void cartBadge.offsetWidth;
      cartBadge.classList.add('bump');
      toast(tributeLines[(tributes - 1) % tributeLines.length]);
      starBurst(btn);
    });
  });

  /* ----- Coming-soon platform buttons ----- */
  document.querySelectorAll('[data-toast]').forEach(function (el) {
    el.addEventListener('click', function () { toast(el.getAttribute('data-toast')); });
  });

  /* ----- $PREZ price: rises while observed ----- */
  var prezPrice = document.getElementById('prezPrice');
  var prezNote = document.getElementById('prezNote');
  var prez = 0.0004;
  if (prezPrice && !reduceMotion) {
    setInterval(function () {
      // A random walk that has been instructed to walk upward.
      var move = (Math.random() - 0.32) * 0.00012;
      prez = Math.max(0.0001, prez + move);
      prezPrice.textContent = '$' + prez.toFixed(4);
      if (move >= 0) {
        prezNote.textContent = '▲ rising';
        prezNote.style.color = '#1c6b2f';
      } else {
        prezNote.textContent = '▲ rising (adjusted)';
        prezNote.style.color = '#1c6b2f';
      }
    }, 1400);
  }

  /* ----- Star burst micro-celebration ----- */
  function starBurst(origin) {
    if (reduceMotion) return;
    var rect = origin.getBoundingClientRect();
    var cx = rect.left + rect.width / 2;
    var cy = rect.top + rect.height / 2;
    for (var i = 0; i < 10; i++) {
      var s = document.createElement('span');
      s.className = 'star-bit';
      s.textContent = Math.random() < 0.8 ? '★' : '🦅';
      s.style.left = cx + 'px';
      s.style.top = cy + 'px';
      s.style.color = ['#e8c95c', '#b3282d', '#efe6d0'][i % 3];
      document.body.appendChild(s);
      var ang = Math.random() * Math.PI * 2;
      var dist = 60 + Math.random() * 90;
      var dx = Math.cos(ang) * dist;
      var dy = Math.sin(ang) * dist - 40;
      s.animate([
        { transform: 'translate(0,0) scale(1) rotate(0deg)', opacity: 1 },
        { transform: 'translate(' + dx + 'px,' + dy + 'px) scale(.3) rotate(' + (Math.random() * 360 - 180) + 'deg)', opacity: 0 }
      ], { duration: 800 + Math.random() * 400, easing: 'cubic-bezier(.19,1,.22,1)' }).onfinish = function (ev) {
        ev.target.effect.target.remove();
      };
    }
  }

  /* ----- Seal easter egg: five clicks ----- */
  var seal = document.getElementById('sealBtn');
  var sealClicks = 0, sealTimer = null;
  if (seal) seal.addEventListener('click', function (e) {
    sealClicks += 1;
    clearTimeout(sealTimer);
    sealTimer = setTimeout(function () { sealClicks = 0; }, 1600);
    if (sealClicks >= 5) {
      sealClicks = 0;
      e.preventDefault();
      starBurst(seal);
      toast('You have been added to a list. Congratulations on the list.');
    }
  });

  /* ----- Random president portrait (mirrors the game's president creator) ----- */
  var portrait = document.getElementById('presidentPortrait');
  if (portrait) {
    var altPortrait = portrait.getAttribute('data-alt');
    if (altPortrait && Math.random() < 0.5) {
      portrait.src = altPortrait;
    }
  }

  /* ----- Footer year ----- */
  var yearEl = document.getElementById('year');
  if (yearEl) yearEl.textContent = new Date().getFullYear();
})();
