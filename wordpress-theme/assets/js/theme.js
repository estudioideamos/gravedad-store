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

  document.querySelectorAll('.related.products, .upsells.products').forEach(section=>{
    const track=section.querySelector('ul.products');
    if(!track||section.querySelector('.carousel-nav')) return;
    const nav=document.createElement('div'); nav.className='carousel-nav';
    const prev=document.createElement('button'); prev.type='button'; prev.textContent='←'; prev.setAttribute('aria-label','Anterior');
    const next=document.createElement('button'); next.type='button'; next.textContent='→'; next.setAttribute('aria-label','Siguiente');
    nav.appendChild(prev); nav.appendChild(next);
    section.insertBefore(nav, track);
    const cardStep=()=>{ const card=track.querySelector('li.product'); return card?card.getBoundingClientRect().width+16:280; };
    const atEnd=()=>track.scrollLeft >= track.scrollWidth - track.clientWidth - 4;
    const scrollByCard=(dir)=>{ track.scrollBy({left:dir*cardStep(),behavior:'smooth'}); };
    prev.addEventListener('click',()=>scrollByCard(-1));
    next.addEventListener('click',()=>scrollByCard(1));

    if(!reduceMotion&&track.querySelectorAll('li.product').length>1){
      let timer=null;
      const advance=()=>{ if(atEnd()){ track.scrollTo({left:0,behavior:'smooth'}); } else { scrollByCard(1); } };
      const start=()=>{ stop(); timer=setInterval(advance,3800); };
      const stop=()=>{ if(timer){ clearInterval(timer); timer=null; } };
      start();
      section.addEventListener('mouseenter',stop);
      section.addEventListener('mouseleave',start);
      section.addEventListener('touchstart',stop,{passive:true});
      section.addEventListener('touchend',start);
      prev.addEventListener('click',start);
      next.addEventListener('click',start);
    }
  });
});
