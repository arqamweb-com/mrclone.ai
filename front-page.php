<?php
/**
 * Front page — the single-page MrClone.AI design.
 *
 * Media lives in assets/images and assets/videos. To swap a film, replace the
 * file with one of the same name (.mp4, H.264). Contact details and the form
 * endpoint are editable under Appearance → Customize → MrClone.AI.
 *
 * @package MrCloneAI
 */

get_header();
?>

<main id="top">
  <!-- HERO -->
  <section class="hero" style="padding-bottom:0">
    <div class="wrap">
      <p class="eyebrow">AI Twin · Content Engine · Dubai</p>
      <h1 style="margin-top:16px">Meet your <span class="grad">Twin.</span></h1>
      <p class="sub">Film once. Show up everywhere.</p>
      <p class="lede">We film you properly for one day, build an AI Twin of you that you approve, then write, produce and publish your videos every month. You never go back to camera.</p>
      <div class="hero-ctas">
        <a class="btn btn-primary" href="#apply" data-plan="twin">Apply now</a>
        <a class="btn btn-link" href="#film" id="watchLink">Watch the film</a>
      </div>
    </div>
    <div class="film" id="film">
      <div class="film-frame" id="filmFrame">
        <video id="heroVideo" src="<?php mrclone_asset( 'videos/mrclone-demo.mp4' ); ?>" poster="<?php mrclone_asset( 'videos/mrclone-demo.jpg' ); ?>" autoplay muted loop playsinline preload="auto" aria-label="MrClone.AI film, presented by Ramses's AI Twin"></video>
        <div class="film-ctrl">
          <button class="chip" id="soundBtn" type="button" aria-pressed="false">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true"><path d="M11 5 6 9H3v6h3l5 4V5z"/><path id="soundWave" d="M23 9l-6 6M17 9l6 6"/></svg>
            <span id="soundLabel">Sound on</span>
          </button>
          <button class="chip" id="pauseBtn" type="button" aria-label="Pause film">
            <svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path id="pauseIcon" d="M7 5h3.5v14H7zM13.5 5H17v14h-3.5z"/></svg>
          </button>
        </div>
      </div>
      <p class="film-note"><span class="dot" aria-hidden="true"></span>Everything in this film is AI. Ramses never stood in front of a camera to record it.</p>
    </div>
  </section>

  <!-- STATEMENT -->
  <section class="statement" id="twin">
    <div class="wrap narrow">
      <p id="statement">You are the bottleneck. Every post, every launch, every reel waits for you to find a free afternoon. When your calendar fills up, your marketing stops. Your Twin keeps going.</p>
    </div>
  </section>

  <!-- CASE STUDY -->
  <section class="case" id="results">
    <div class="wrap">
      <div class="head center rv">
        <p class="eyebrow">Case study · Don’t Sit Get Fit</p>
        <h2 class="h-xl center">One Twin. Thirty days.<br><span class="grad">65,000 views.</span></h2>
        <p class="lede center">We built Don’t Sit Get Fit from the first frame: the brand, the films, Michael’s AI Twin and the content engine behind it. This is month one.</p>
      </div>

      <div class="kpis rv">
        <div class="kpi"><b class="grad">65K</b><span>views in October</span><small>Up 6,564% on September</small></div>
        <div class="kpi"><b>+10,322</b><span>new followers in 30 days</span><small>From an audience starting near zero</small></div>
        <div class="kpi"><b>1.3K</b><span>followers from a single reel</span><small>The month’s top performer</small></div>
        <div class="kpi"><b>15</b><span>reels published</span><small>Plus 13 stories, all on schedule</small></div>
      </div>

      <div class="phones rv" aria-label="Instagram insights for @dontsit.getfit">
        <figure class="phone"><img src="<?php mrclone_asset( 'images/ig-profile.jpg' ); ?>" alt="Instagram profile of @dontsit.getfit showing 20.5K followers and 65.7K views in the last 30 days" loading="lazy" width="640" height="1287"></figure>
        <figure class="phone"><img src="<?php mrclone_asset( 'images/ig-recap.jpg' ); ?>" alt="Instagram October recap: 65K views, up 6,564% from September, and 10,322 new followers" loading="lazy" width="640" height="1303"></figure>
        <figure class="phone"><img src="<?php mrclone_asset( 'images/ig-chart.jpg' ); ?>" alt="Instagram chart showing views rising from near zero to over 60K during October" loading="lazy" width="640" height="1303"></figure>
        <figure class="phone"><img src="<?php mrclone_asset( 'images/ig-top-reel.jpg' ); ?>" alt="Instagram insight: one reel gained 1.3K followers" loading="lazy" width="640" height="1303"></figure>
      </div>
      <p class="source rv">Straight from Instagram. Insights for <a href="https://www.instagram.com/dontsit.getfit/" target="_blank" rel="noopener">@dontsit.getfit</a>, October 2026. Today: 20.5K followers and climbing.</p>

      <div class="sub-head rv">
        <h3 class="h-m">Filmed once.<br><span class="dim">Then never again.</span></h3>
        <p class="lede">Michael spent one session with us. The reels that built his audience were made by his Twin. Same face, same voice, same energy.</p>
      </div>
      <div class="ba rv">
        <figure class="ba-card"><span class="tagchip">Before · Filming day</span><img src="<?php mrclone_asset( 'images/michael-filming-day.jpg' ); ?>" alt="Michael Nelson on set during his one filming day" loading="lazy"></figure>
        <figure class="ba-card"><span class="tagchip is-twin">After · AI Twin</span><img src="<?php mrclone_asset( 'images/michael-twin.jpg' ); ?>" alt="Michael Nelson's AI Twin in a gym setting" loading="lazy"></figure>
        <figure class="vfilm reel">
            <span class="tagchip">The result · Watch</span>
            <video controls src="<?php mrclone_asset( 'videos/film-coaches.mp4' ); ?>" poster="<?php mrclone_asset( 'videos/film-coaches.jpg' ); ?>" playsinline preload="metadata" aria-label="Film: real MrClone.AI results for a real coach"></video>
            <button class="play" type="button" aria-label="Play with sound"><span><svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M6 4l15 8-15 8z"/></svg>Play with sound</span></button>
          </figure>
      </div>

      <div class="sub-head rv">
        <h3 class="h-m">We built the brand, too.</h3>
        <p class="lede">The commercial and the founder intro, shot by the Ramses Studio crew in Dubai.</p>
      </div>
      <div class="work">
        <figure class="reel rv">
          <div class="vid">
            <video controls src="<?php mrclone_asset( 'videos/dsgf-commercial.mp4' ); ?>" poster="<?php mrclone_asset( 'videos/dsgf-commercial.jpg' ); ?>" preload="metadata" playsinline aria-label="Don't Sit Get Fit commercial"></video>
            <button class="play" type="button" aria-label="Play the Don't Sit Get Fit commercial with sound"><span><svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M6 4l15 8-15 8z"/></svg>Play · 0:14</span></button>
          </div>
          <figcaption><strong>The Commercial</strong><span>Brand film shot across Dubai</span></figcaption>
        </figure>
        <figure class="reel rv">
          <div class="vid">
            <video controls src="<?php mrclone_asset( 'videos/dsgf-intro.mp4' ); ?>" poster="<?php mrclone_asset( 'videos/dsgf-intro.jpg' ); ?>" preload="metadata" playsinline aria-label="Don't Sit Get Fit brand intro"></video>
            <button class="play" type="button" aria-label="Play the Don't Sit Get Fit brand intro with sound"><span><svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M6 4l15 8-15 8z"/></svg>Play · 0:24</span></button>
          </div>
          <figcaption><strong>The Founder Intro</strong><span>Michael’s story, with animated captions</span></figcaption>
        </figure>
      </div>
      <div class="case-cta rv">
        <a class="btn btn-primary" href="#apply" data-plan="twin">Get results like these</a>
      </div>
    </div>
  </section>

  <!-- NUMBERS -->
  <section class="band">
    <div class="wrap split">
      <div class="split-copy">
        <div class="head rv">
          <p class="eyebrow">One engagement</p>
          <h2 class="h-l">A month of content.<br>From one day of yours.</h2>
          <p class="lede">Scripted, produced and scheduled. On launch day it all goes live, and the signals start rolling in.</p>
        </div>
        <div class="stats stats-2 rv">
          <div class="stat"><b>1</b><span>filming day</span></div>
          <div class="stat"><b class="grad">12</b><span>short-form videos</span></div>
          <div class="stat"><b>30</b><span>days to delivery</span></div>
          <div class="stat"><b>4</b><span>platforms, cut natively</span></div>
        </div>
      </div>
      <div class="rv">
        <figure class="vfilm reel">
            <span class="tagchip">Film · Launch Day</span>
            <video controls src="<?php mrclone_asset( 'videos/film-launch.mp4' ); ?>" poster="<?php mrclone_asset( 'videos/film-launch.jpg' ); ?>" playsinline preload="metadata" aria-label="Film: Launch Day"></video>
            <button class="play" type="button" aria-label="Play with sound"><span><svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M6 4l15 8-15 8z"/></svg>Play with sound</span></button>
          </figure>
      </div>
    </div>
  </section>

  <!-- HOW IT WORKS -->
  <section>
    <div class="wrap">
      <div class="head rv">
        <p class="eyebrow">How it works</p>
        <h2 class="h-xl">Three steps.<br><span class="dim">You do one of them.</span></h2>
      </div>
      <div class="steps">
        <article class="step rv">
          <span class="n">01</span>
          <h3>Film once.</h3>
          <p>One studio day with a cinema crew. We capture your face, your voice and the way you explain things, so your Twin sounds like you on a good day.</p>
        </article>
        <article class="step rv">
          <span class="n">02</span>
          <h3>Approve your Twin.</h3>
          <p>We build your AI Twin and show it to you first. Nothing gets produced until you are happy with how it looks and sounds.</p>
        </article>
        <article class="step rv">
          <span class="n">03</span>
          <h3>Publish everywhere.</h3>
          <p>We write the scripts, produce the videos and cut them for Instagram, TikTok, YouTube Shorts and Facebook. You approve each one before it goes out.</p>
        </article>
      </div>

      <div class="sub-head rv">
        <h3 class="h-m">From one reference<br><span class="dim">to a cinematic Twin.</span></h3>
        <p class="lede">Ramses’s own Twin. Captured in a single session, then directed like a film: new looks, new locations, no camera crew.</p>
      </div>
      <div class="ref rv">
        <figure class="ref-card"><span class="tagchip">Before · The reference</span><img src="<?php mrclone_asset( 'images/ramses-reference.jpg' ); ?>" alt="Ramses Othman reference capture: headshot and full-length look on a white background" loading="lazy" width="1600" height="905"></figure>
        <figure class="vfilm ref-film reel">
            <span class="tagchip">After · The Twin</span>
            <video controls src="<?php mrclone_asset( 'videos/film-after.mp4' ); ?>" poster="<?php mrclone_asset( 'videos/film-after.jpg' ); ?>" playsinline preload="metadata" aria-label="Ramses's AI Twin in a cinematic scene"></video>
            <button class="play" type="button" aria-label="Play with sound"><span><svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M6 4l15 8-15 8z"/></svg>Play with sound</span></button>
          </figure>
      </div>
    </div>
  </section>

  <!-- LANGUAGES -->
  <section class="band">
    <div class="wrap split">
      <div class="split-copy langs">
        <div class="head rv" style="margin-bottom:0">
          <p class="eyebrow">Multilingual</p>
          <h2 class="h-l">One founder.<br><span class="grad">Every market.</span></h2>
          <p class="lede">The same ideas, delivered by your Twin in the language of each market, with local references that land. Reach the Gulf, Europe and beyond without a second shoot.</p>
        </div>
        <div class="lang-stage" aria-hidden="true">
          <span class="on">Hello.</span><span dir="rtl" lang="ar">مرحباً.</span><span lang="ru">Привет.</span><span lang="de">Hallo.</span>
        </div>
        <ul class="lang-list" aria-label="Example languages">
          <li class="on">English</li><li>Arabic</li><li>Russian</li><li>German</li>
        </ul>
      </div>
      <div class="rv">
        <figure class="vfilm reel">
            <span class="tagchip">Film · One Founder, Every Market</span>
            <video controls src="<?php mrclone_asset( 'videos/film-markets.mp4' ); ?>" poster="<?php mrclone_asset( 'videos/film-markets.jpg' ); ?>" playsinline preload="metadata" aria-label="Film: One Founder, Every Market"></video>
            <button class="play" type="button" aria-label="Play with sound"><span><svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M6 4l15 8-15 8z"/></svg>Play with sound</span></button>
          </figure>
      </div>
    </div>
  </section>

  <!-- FOUNDER -->
  <section class="band" id="ramses">
    <div class="wrap">
      <figure class="portrait rv">
        <img src="<?php mrclone_asset( 'images/ramses.jpg' ); ?>" alt="Ramses Othman, founder of MrClone.AI, in front of the MrClone.AI wordmark" width="1800" height="1005" loading="lazy" decoding="async">
      </figure>
    </div>
    <div class="wrap founder">
      <div class="rv">
        <p class="eyebrow" style="margin-bottom:20px">Directed by Ramses</p>
        <blockquote>“Most AI video looks like AI video. Ours starts on a real set, with real light, because the Twin can only be as good as the day we film.”</blockquote>
        <p class="who"><b>Ramses Othman</b>, founder of MrClone.AI and Ramses Studio. Twelve years behind the camera.</p>
        <p class="press">Featured in <a href="https://lucire.com/2024/1228ll0.shtml" target="_blank" rel="noopener">Lucire Global Fashion Magazine</a>, 2024.</p>
      </div>
      <div class="rv">
        <p class="dim" style="margin-bottom:16px;font-size:.95rem">Ramses Studio has filmed for</p>
        <ul class="brands">
          <li>Hilton</li><li>Fairmont</li><li>Nike</li><li>Canon</li><li>Harley‑Davidson</li><li>UAE Royal Clients</li>
        </ul>
      </div>
    </div>
  </section>

  <!-- BEHIND THE SCENES -->
  <section class="bts" id="bts">
    <div class="wrap">
      <div class="head rv">
        <p class="eyebrow">Behind the scenes</p>
        <h2 class="h-xl">Every detail,<br><span class="dim">directed in person.</span></h2>
        <p class="lede">A Twin is only as good as the day it’s filmed. Our co-founder, Ramses Othman, runs every shoot himself: the light, the framing, the wardrobe, the performance. He watches every take on the monitor, so nothing reaches your audience by accident.</p>
      </div>
      <div class="bts-grid">
        <figure class="reel bts-film rv">
          <div class="vid">
            <video controls src="<?php mrclone_asset( 'videos/bts-on-set.mp4' ); ?>" poster="<?php mrclone_asset( 'videos/bts-on-set.jpg' ); ?>" preload="metadata" playsinline aria-label="Behind the scenes on set with Michael Nelson"></video>
            <button class="play" type="button" aria-label="Play the behind-the-scenes video with sound"><span><svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M6 4l15 8-15 8z"/></svg>Play with sound</span></button>
          </div>
          <figcaption><strong>On set</strong><span>Michael’s filming day, Dubai</span></figcaption>
        </figure>
        <figure class="bts-shot rv"><div class="ph"><img src="<?php mrclone_asset( 'images/bts/bts-2889.jpg' ); ?>" alt="Michael Nelson on a lit studio set, framed by a cinema camera" loading="lazy" style="object-position:30% 50%"></div>
          <figcaption><strong>The set</strong><span>Cinema camera, shaped light, one subject</span></figcaption></figure>
        <figure class="bts-shot rv"><div class="ph"><img src="<?php mrclone_asset( 'images/bts/bts-2898.jpg' ); ?>" alt="Ramses Othman directing beside the camera with a monitor in hand" loading="lazy" style="object-position:62% 50%"></div>
          <figcaption><strong>The director</strong><span>Ramses checks every frame</span></figcaption></figure>
        <figure class="bts-shot rv"><div class="ph"><img src="<?php mrclone_asset( 'images/bts/bts-2951.jpg' ); ?>" alt="Michael Nelson and Ramses Othman together on set after the shoot" loading="lazy" style="object-position:55% 50%"></div>
          <figcaption><strong>That’s a wrap</strong><span>Michael and Ramses after the shoot</span></figcaption></figure>
      </div>
    </div>
  </section>

  <!-- LEVERAGE HOOK -->
  <section class="leverage" id="leverage">
    <div class="wrap center">
      <p class="eyebrow rv">The point of all this</p>
      <h2 class="lev-h rv">Your Twin builds the business.<br><span class="grad">You live the life.</span></h2>
      <div class="lev-lines rv">
        <p>While your Twin posts in four languages,</p>
        <p>you’re at dinner with your family.</p>
        <p>On a flight.</p>
        <p>Closing the deal that actually matters.</p>
      </div>
      <p class="lev-punch rv">That’s not laziness. <span>That’s leverage.</span></p>
      <div class="hero-ctas rv"><a class="btn btn-primary" href="#apply" data-plan="twin">Build my Twin</a></div>
    </div>
  </section>

  <!-- PLANS -->
  <section id="plans">
    <div class="wrap">
      <div class="head center rv">
        <p class="eyebrow">Plans</p>
        <h2 class="h-xl center">Which one is right for you?</h2>
        <p class="lede center">Both are done for you, end to end. Pricing is fixed monthly scope, shared after your application.</p>
      </div>
      <div class="compare">
        <article class="plan lead rv">
          <span class="tag">Recommended</span>
          <h3>AI Twin Engine</h3>
          <p class="for">For founders, coaches and creators who need to post every week but cannot film every week.</p>
          <ul>
            <li><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12l5 5L20 7"/></svg>One studio filming day</li>
            <li><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12l5 5L20 7"/></svg>Your AI Twin, built and approved by you</li>
            <li><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12l5 5L20 7"/></svg>12 short-form videos every 30 days</li>
            <li><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12l5 5L20 7"/></svg>Scripts written for you, in your voice</li>
            <li><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12l5 5L20 7"/></svg>Cut for Reels, TikTok, Shorts and Facebook</li>
            <li><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12l5 5L20 7"/></svg>Extra languages available</li>
          </ul>
          <div class="foot">
            <a class="btn btn-primary" href="#apply" data-plan="twin">Apply for the AI Twin</a>
            <small>Limited onboarding spots each month.</small>
          </div>
        </article>
        <article class="plan rv">
          <span class="tag tag-ghost">Dubai founders</span>
          <h3>Founder Channel Sprint</h3>
          <p class="for">For Dubai founders who want a YouTube channel that looks like their company, not their webcam.</p>
          <ul>
            <li><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12l5 5L20 7"/></svg>Cinematic shoot with the Ramses Studio crew</li>
            <li><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12l5 5L20 7"/></svg>Done-for-you long-form YouTube production</li>
            <li><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12l5 5L20 7"/></svg>Channel set up, titled and packaged</li>
            <li><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12l5 5L20 7"/></svg>Monthly retainer after the sprint</li>
            <li><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12l5 5L20 7"/></svg>Language versions for new markets</li>
            <li><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12l5 5L20 7"/></svg>Flat pricing, no revenue share</li>
          </ul>
          <div class="foot">
            <a class="btn btn-primary" href="#apply" data-plan="sprint" style="background:var(--fg);color:var(--ink)">Apply for the Sprint</a>
            <small>Dubai-based founders.</small>
          </div>
        </article>
      </div>
    </div>
  </section>

  <!-- CONTROL -->
  <section class="band">
    <div class="wrap">
      <div class="head rv">
        <p class="eyebrow">Your face. Your rules.</p>
        <h2 class="h-l">You stay in control.</h2>
      </div>
      <div class="trust">
        <div class="rv">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M20 6 9 17l-5-5"/><circle cx="12" cy="12" r="10.5" stroke-opacity=".35"/></svg>
          <h3>Nothing goes out unapproved.</h3>
          <p>You sign off on your Twin, every script and every final cut. If you don’t approve it, it doesn’t publish.</p>
        </div>
        <div class="rv">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="4" y="10.5" width="16" height="10.5" rx="2.5"/><path d="M8 10.5V7a4 4 0 0 1 8 0v3.5"/></svg>
          <h3>Your Twin works only for you.</h3>
          <p>Your likeness and voice are used for your content and nothing else.</p>
        </div>
        <div class="rv">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="3.5" y="4.5" width="17" height="16" rx="2.5"/><path d="M3.5 9.5h17M8 2.5v4M16 2.5v4"/></svg>
          <h3>A fixed monthly scope.</h3>
          <p>You know what you get each month and what it costs. Flat pricing, no revenue share, no surprises.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- FAQ -->
  <section id="faq">
    <div class="wrap narrow">
      <div class="head rv">
        <p class="eyebrow">FAQ</p>
        <h2 class="h-l">Questions, answered.</h2>
      </div>
      <div class="faq rv">
        <details><summary>Will my audience know it’s AI?</summary><p>That’s your call, and we’ll advise you. Some clients label their Twin content openly and use it as a talking point. Where a platform requires AI disclosure, we follow its rules.</p></details>
        <details><summary>How much of my time does this take?</summary><p>One filming day to start. After that, about an hour a month to approve scripts and final cuts.</p></details>
        <details><summary>What do I need to prepare for the filming day?</summary><p>Just yourself and a few outfits. We bring the crew, lighting and set, and we send a short brief beforehand on what we will cover.</p></details>
        <details><summary>Which languages can my Twin speak?</summary><p>English, Arabic, Russian, German and more. Tell us your markets in the application and we’ll confirm what fits.</p></details>
        <details><summary>Do you work with clients outside Dubai?</summary><p>Yes. We are based in Dubai and serve clients worldwide. Filming happens in Dubai or we travel to you.</p></details>
        <details><summary>Why apply instead of booking a call?</summary><p>We take on a limited number of clients each month so every Twin gets the attention it needs. The application helps us confirm we’re a fit before either of us spends time on a call.</p></details>
      </div>
    </div>
  </section>

  <!-- APPLY -->
  <section class="band" id="apply">
    <div class="wrap apply">
      <div class="apply-copy rv">
        <p class="eyebrow">Apply</p>
        <h2 class="h-l">Let’s build your Twin.</h2>
        <p class="dim">Two minutes. We read every application personally.</p>
        <ol>
          <li>Send your application.</li>
          <li>We reply within 24 hours if we’re a fit.</li>
          <li>A 30-minute call to plan your filming day.</li>
        </ol>
        <p class="contact-line">Prefer to talk first? <a href="<?php echo esc_url( mrclone_whatsapp_url() ); ?>" target="_blank" rel="noopener">WhatsApp <?php echo esc_html( mrclone_opt( 'whatsapp_display' ) ); ?></a> · <a href="mailto:<?php echo esc_attr( mrclone_opt( 'email' ) ); ?>"><?php echo esc_html( mrclone_opt( 'email' ) ); ?></a></p>
      </div>

      <div class="rv">
        <form id="applyForm" novalidate>
          <div class="row">
            <div class="field"><label for="f-name">Full name</label><input id="f-name" name="name" autocomplete="name" required></div>
            <div class="field"><label for="f-email">Email</label><input id="f-email" name="email" type="email" autocomplete="email" required></div>
          </div>
          <div class="row">
            <div class="field"><label for="f-phone">WhatsApp number</label><input id="f-phone" name="whatsapp" type="tel" autocomplete="tel" placeholder="+971 …" required></div>
            <div class="field"><label for="f-link">Instagram or website</label><input id="f-link" name="link" placeholder="@yourbrand" required></div>
          </div>
          <fieldset class="field">
            <legend>Which plan interests you?</legend>
            <div class="pills">
              <label><input type="radio" name="plan" value="AI Twin Engine" id="p-twin"><span>AI Twin Engine</span></label>
              <label><input type="radio" name="plan" value="Founder Channel Sprint" id="p-sprint"><span>Founder Channel Sprint</span></label>
              <label><input type="radio" name="plan" value="Not sure yet" id="p-unsure"><span>Not sure yet</span></label>
            </div>
          </fieldset>
          <div class="row">
            <div class="field"><label for="f-audience">Audience size</label>
              <select id="f-audience" name="audience" required>
                <option value="">Choose one</option><option>Under 10K</option><option>10K–50K</option><option>50K–500K</option><option>500K+</option><option>Starting from zero</option>
              </select></div>
            <div class="field"><label for="f-budget">Monthly marketing budget</label>
              <select id="f-budget" name="budget" required>
                <option value="">Choose one</option><option>Under AED 5,000</option><option>AED 5,000–10,000</option><option>AED 10,000–20,000</option><option>AED 20,000+</option>
              </select></div>
          </div>
          <div class="field"><label for="f-start">When do you want to start?</label>
            <select id="f-start" name="start" required>
              <option value="">Choose one</option><option>This month</option><option>In 1–3 months</option><option>Just exploring</option>
            </select></div>
          <div class="field"><label for="f-goal">What should your content achieve?</label><textarea id="f-goal" name="goal" placeholder="More clients, a product launch, a new market…"></textarea></div>
          <div class="hp" aria-hidden="true"><label for="f-company-website">Leave this empty</label><input id="f-company-website" name="company_website" tabindex="-1" autocomplete="off"></div>
          <p class="form-error" id="formError" role="alert" hidden></p>
          <div class="form-foot">
            <button class="btn btn-primary" type="submit" id="submitBtn">Send application</button>
            <small>We use your details only to reply to your application.</small>
          </div>
        </form>

        <div class="done" id="done" hidden tabindex="-1">
          <p class="eyebrow">Almost done</p>
          <h3 id="doneTitle">Send it on WhatsApp.</h3>
          <p id="doneText">Your application is ready. Tap below to send it to Ramses on WhatsApp, and you’ll hear back within 24 hours.</p>
          <a class="btn btn-primary" id="waSend" href="<?php echo esc_url( mrclone_whatsapp_url() ); ?>" target="_blank" rel="noopener">Send on WhatsApp</a>
          <p class="contact-line">Or email it to <a href="mailto:<?php echo esc_attr( mrclone_opt( 'email' ) ); ?>"><?php echo esc_html( mrclone_opt( 'email' ) ); ?></a></p>
        </div>
      </div>
    </div>
  </section>

  <!-- FINAL -->
  <section class="final">
    <div class="wrap rv">
      <h2>Be seen.<br><span class="grad">Be chosen.</span></h2>
      <div class="hero-ctas">
        <a class="btn btn-primary" href="#apply" data-plan="twin">Apply now</a>
        <a class="btn btn-link" href="#film">Watch the film again</a>
      </div>
    </div>
  </section>
</main>

<?php get_footer(); ?>
