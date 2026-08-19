function gravedadSmoothScrollTo(el,targetLeft,duration){
  const startLeft=el.scrollLeft;
  const distance=targetLeft-startLeft;
  const startTime=performance.now();
  const ease=(t)=>t<.5?4*t*t*t:1-Math.pow(-2*t+2,3)/2;
  function step(now){
    const elapsed=now-startTime;
    const progress=Math.min(elapsed/duration,1);
    el.scrollLeft=startLeft+distance*ease(progress);
    if(progress<1) requestAnimationFrame(step);
  }
  requestAnimationFrame(step);
}

document.addEventListener('DOMContentLoaded',()=>{
  const menuButton=document.querySelector('.menu-toggle');
  const nav=document.querySelector('.main-nav');
  const goTop=document.querySelector('.go-top');
  const filterButton=document.querySelector('.singles-filter-toggle');
  const filters=document.querySelector('.singles-filters');
  if(menuButton&&nav) menuButton.addEventListener('click',()=>{const open=nav.classList.toggle('is-open');menuButton.setAttribute('aria-expanded',String(open))});
  document.querySelectorAll('.main-nav a').forEach(link=>link.addEventListener('click',()=>nav?.classList.remove('is-open')));
  const updateTop=()=>goTop?.classList.toggle('is-visible',window.scrollY>500);
  window.addEventListener('scroll',updateTop,{passive:true}); updateTop();
  goTop?.addEventListener('click',()=>window.scrollTo({top:0,behavior:'smooth'}));
  filterButton?.addEventListener('click',()=>{const open=filters?.classList.toggle('is-open');filterButton.setAttribute('aria-expanded',String(Boolean(open)))});

  const reduceMotion=window.matchMedia('(prefers-reduced-motion: reduce)').matches;
  const updateScrolled=()=>document.body.classList.toggle('is-scrolled',window.scrollY>10);
  window.addEventListener('scroll',updateScrolled,{passive:true}); updateScrolled();

  if(!reduceMotion&&'IntersectionObserver' in window){
    const revealTargets=document.querySelectorAll('.games-grid>a,.product-cards>article,.feature-categories>a,.benefits>div,.event-copy,.event-visual,.woocommerce ul.products>li,.related.products ul.products>li');
    const io=new IntersectionObserver((entries)=>{
      entries.forEach(entry=>{ if(entry.isIntersecting){ entry.target.classList.add('is-visible'); io.unobserve(entry.target); } });
    },{threshold:.15,rootMargin:'0px 0px -40px 0px'});
    revealTargets.forEach((el,i)=>{ el.classList.add('js-reveal'); el.style.transitionDelay=(i%6)*70+'ms'; io.observe(el); });
  }

  const cartLink=document.querySelector('.header-cart');
  const cartCount=document.querySelector('.header-cart .cart-count');
  if(cartLink&&cartCount&&'MutationObserver' in window){
    let lastCount=cartCount.textContent;
    const mo=new MutationObserver(()=>{
      if(cartCount.textContent!==lastCount){
        lastCount=cartCount.textContent;
        if(!reduceMotion){ cartLink.classList.remove('is-bumping'); void cartLink.offsetWidth; cartLink.classList.add('is-bumping'); }
      }
    });
    mo.observe(cartCount,{childList:true,characterData:true,subtree:true});
  }

  document.querySelectorAll('.woocommerce div.product .quantity').forEach(wrap=>{
    const input=wrap.querySelector('input.qty');
    if(!input||wrap.querySelector('.qty-step')) return;
    const minus=document.createElement('button'); minus.type='button'; minus.className='qty-step qty-minus'; minus.textContent='−'; minus.setAttribute('aria-label','Restar');
    const plus=document.createElement('button'); plus.type='button'; plus.className='qty-step qty-plus'; plus.textContent='+'; plus.setAttribute('aria-label','Sumar');
    wrap.insertBefore(minus,input); wrap.appendChild(plus);
    const step=parseFloat(input.step)||1, min=parseFloat(input.min)||1, max=input.max?parseFloat(input.max):Infinity;
    const setVal=(v)=>{ input.value=Math.max(min,Math.min(max,v)); input.dispatchEvent(new Event('change',{bubbles:true})); };
    minus.addEventListener('click',()=>setVal((parseFloat(input.value)||min)-step));
    plus.addEventListener('click',()=>setVal((parseFloat(input.value)||min)+step));
  });

  (function freeRelatedFromProductGrid(){
    const productEl=document.querySelector('div.product');
    if(!productEl||!productEl.parentNode) return;
    const stray=productEl.querySelectorAll(':scope > .related.products, :scope > .upsells.products');
    stray.forEach(section=>{ productEl.parentNode.insertBefore(section, productEl.nextSibling); });
  })();

  (function buildProductAccordion(){
    const tabsWrap=document.querySelector('.woocommerce-tabs');
    const summary=document.querySelector('div.product div.summary');
    if(!tabsWrap||!summary) return;
    const tabLinks=[...tabsWrap.querySelectorAll('ul.tabs > li > a')];
    if(!tabLinks.length) return;
    const accordion=document.createElement('div');
    accordion.className='product-accordion';
    tabLinks.forEach((link,i)=>{
      const panel=tabsWrap.querySelector(link.getAttribute('href'));
      if(!panel) return;
      const panelHeading=panel.querySelector(':scope > h2');
      if(panelHeading) panelHeading.remove();
      const item=document.createElement('div');
      item.className='accordion-item'+(i===0?' is-open':'');
      const trigger=document.createElement('button');
      trigger.type='button'; trigger.className='accordion-trigger';
      trigger.innerHTML='<span>'+link.textContent.trim()+'</span><i>+</i>';
      const body=document.createElement('div');
      body.className='accordion-body';
      body.appendChild(panel);
      trigger.addEventListener('click',()=>{
        const wasOpen=item.classList.contains('is-open');
        accordion.querySelectorAll('.accordion-item').forEach(el=>el.classList.remove('is-open'));
        if(!wasOpen) item.classList.add('is-open');
      });
      item.appendChild(trigger); item.appendChild(body);
      accordion.appendChild(item);
    });
    summary.appendChild(accordion);
    tabsWrap.remove();
  })();

  document.querySelectorAll('.related.products, .upsells.products, .product-cards').forEach(outer=>{
    const isCards=outer.classList.contains('product-cards');
    const track=isCards?outer:outer.querySelector('ul.products');
    const itemSelector=isCards?':scope > .gravity-product':'li.product';
    if(!track||track.dataset.carouselReady) return;
    const items=[...track.querySelectorAll(itemSelector)];
    if(items.length<2) return;
    track.dataset.carouselReady='1';

    const sizeItems=()=>{
      const w=window.innerWidth;
      const cols=w<=650?2:(w<=1200?3:5);
      const gap=16;
      const basis='calc((100% - '+(gap*(cols-1))+'px)/'+cols+')';
      items.forEach(it=>{ it.style.flex='0 0 '+basis; it.style.width='auto'; });
    };
    sizeItems();
    window.addEventListener('resize',sizeItems);

    const wrap=document.createElement('div'); wrap.className='carousel-wrap';
    track.parentNode.insertBefore(wrap, track);
    wrap.appendChild(track);
    const prevBtn=document.createElement('button'); prevBtn.type='button'; prevBtn.className='carousel-arrow prev'; prevBtn.innerHTML='‹'; prevBtn.setAttribute('aria-label','Anterior');
    const nextBtn=document.createElement('button'); nextBtn.type='button'; nextBtn.className='carousel-arrow next'; nextBtn.innerHTML='›'; nextBtn.setAttribute('aria-label','Siguiente');
    wrap.appendChild(prevBtn); wrap.appendChild(nextBtn);
    const dotsWrap=document.createElement('div'); dotsWrap.className='carousel-dots';
    wrap.insertAdjacentElement('afterend', dotsWrap);

    const cardStep=()=>{ const c=track.querySelector(itemSelector); return c?c.getBoundingClientRect().width+16:280; };
    const perPage=()=>Math.max(1, Math.round(track.clientWidth/cardStep()));
    const maxScroll=()=>track.scrollWidth-track.clientWidth;
    const atEnd=()=>track.scrollLeft>=maxScroll()-4;
    const scrollByCard=(dir)=>{ gravedadSmoothScrollTo(track, Math.max(0,Math.min(track.scrollLeft+dir*cardStep(), maxScroll())), 700); };

    let timer=null;
    const advance=()=>{ if(atEnd()){ gravedadSmoothScrollTo(track,0,900); } else { scrollByCard(1); } };
    const start=()=>{ if(reduceMotion) return; stop(); timer=setInterval(advance,3800); };
    const stop=()=>{ if(timer){ clearInterval(timer); timer=null; } };

    let dotEls=[];
    const syncDots=()=>{
      const page=Math.round(track.scrollLeft/(perPage()*cardStep()));
      dotEls.forEach((d,i)=>d.classList.toggle('is-active', i===Math.min(page,dotEls.length-1)));
    };
    const buildDots=()=>{
      dotsWrap.innerHTML=''; dotEls=[];
      const count=Math.max(1, Math.ceil(items.length/perPage()));
      for(let i=0;i<count;i++){
        const d=document.createElement('button'); d.type='button'; d.className='carousel-dot'; d.setAttribute('aria-label','Ir a la página '+(i+1));
        d.addEventListener('click',()=>{ stop(); gravedadSmoothScrollTo(track, Math.min(i*perPage()*cardStep(), maxScroll()), 600); start(); });
        dotsWrap.appendChild(d); dotEls.push(d);
      }
      syncDots();
    };

    prevBtn.addEventListener('click',()=>{ scrollByCard(-1); start(); });
    nextBtn.addEventListener('click',()=>{ scrollByCard(1); start(); });
    track.addEventListener('scroll',()=>{ clearTimeout(track._dotTimer); track._dotTimer=setTimeout(syncDots,80); },{passive:true});
    window.addEventListener('resize',()=>{ clearTimeout(wrap._resizeTimer); wrap._resizeTimer=setTimeout(buildDots,200); });
    wrap.addEventListener('mouseenter',stop);
    wrap.addEventListener('mouseleave',start);
    wrap.addEventListener('touchstart',stop,{passive:true});
    wrap.addEventListener('touchend',start);

    buildDots();
    start();
  });
});
