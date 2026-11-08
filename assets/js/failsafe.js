/* failsafe: if anything crashes, reveal the site statically */
(function(){
  var fired = false;
  function reveal(){
    if(fired) return; fired = true;
    var l = document.getElementById('loader');
    if(l && getComputedStyle(l).display !== 'none'){
      l.style.transition = 'opacity .5s'; l.style.opacity = '0';
      setTimeout(function(){ l.style.display = 'none'; }, 550);
    }
  }
  window.addEventListener('error', function(){
    document.documentElement.classList.add('no-js');
    reveal();
  }, true);
  setTimeout(function(){
    var n = document.getElementById('lNum');
    if(n && n.textContent === '0'){ document.documentElement.classList.add('no-js'); }
    reveal();
  }, 4000);
  window.__loaderDone = function(){ fired = true; };
})();
