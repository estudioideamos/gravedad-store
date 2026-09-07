function gravedadSmoothScrollTo(el,targetLeft,duration){
  const startLeft=el.scrollLeft;
  const distance=targetLeft-startLeft;
  const startTime=performance.now();
  const ease=(t)=>t<.5?8*t*t*t*t:1-Math.pow(-2*t+2,4)/2;
  function step(now){
    const elapsed=now-startTime;
    const progress=Math.min(elapsed/duration,1);
    el.scrollLeft=startLeft+distance*ease(progress);
    if(progress<1) requestAnimationFrame(step);
  }
  requestAnimationFrame(step);
}

(function(){
  const FAV_KEY='gravedad_favorites';
  function getFavorites(){ try{ const v=JSON.parse(localStorage.getItem(FAV_KEY)); return Array.isArray(v)?v:[]; }catch(e){ return []; } }
  function setFavorites(ids){ try{ localStorage.setItem(FAV_KEY, JSON.stringify(ids)); }catch(e){} updateFavUI(); }
  function toggleFavorite(id){
    const ids=getFavorites(); const idx=ids.indexOf(id);
    if(idx>-1){ ids.splice(idx,1); } else { ids.push(id); }
    setFavorites(ids);
    return idx===-1;
  }
  function updateFavUI(){
    const ids=getFavorites().map(String);
    document.querySelectorAll('.fav-toggle').forEach(btn=>{
      btn.classList.toggle('is-active', ids.includes(String(btn.dataset.productId)));
    });
    document.querySelectorAll('.fav-count').forEach(el=>{
      el.textContent=String(ids.length); el.hidden=ids.length===0;
    });
  }
  document.addEventListener('click',(e)=>{
    const btn=e.target.closest('.fav-toggle');
    if(!btn) return;
    e.preventDefault(); e.stopPropagation();
    const nowFav=toggleFavorite(String(btn.dataset.productId));
    btn.classList.add('is-bumping');
    setTimeout(()=>btn.classList.remove('is-bumping'),400);
  });
  document.querySelectorAll('[data-carousel-filters]').forEach(filterBar=>{
    const section=filterBar.closest('.featured-products');
    const cardsWrap=section?section.querySelector('[data-filterable-cards]'):null;
    if(!cardsWrap) return;
    const cards=[...cardsWrap.querySelectorAll('.gravity-product')];
    const noResults=cardsWrap.querySelector('.qf-no-results');
    const selects=[...filterBar.querySelectorAll('select[data-filter-key]')];
    function applyFilters(){
      const active=selects.filter(s=>s.value).map(s=>({key:s.dataset.filterKey, value:s.value}));
      let visibleCount=0;
      cards.forEach(card=>{
        const matches=active.every(f=>{
          const raw=card.dataset[f.key]||'';
          return raw.split(' ').includes(f.value);
        });
        card.hidden=!matches;
        if(matches) visibleCount++;
      });
      if(noResults) noResults.hidden=visibleCount>0;
    }
    selects.forEach(s=>s.addEventListener('change',applyFilters));
  });

  document.addEventListener('DOMContentLoaded',()=>{
    updateFavUI();
    const favGrid=document.querySelector('[data-favorites-grid]');
    if(!favGrid) return;
    const ids=getFavorites();
    if(!ids.length){ favGrid.className='favorites-empty'; var shopUrl=(window.gravedadAjax&&window.gravedadAjax.shopUrl)?window.gravedadAjax.shopUrl:window.location.origin+'/'; favGrid.innerHTML='<p>Todavía no agregaste productos a favoritos.</p><a class="button primary" href="'+shopUrl+'">Explorar la tienda →</a>'; return; }
    if(!window.gravedadAjax){ favGrid.innerHTML='<p>No se pudieron cargar los favoritos.</p>'; return; }
    const formData=new FormData();
    formData.append('action','gravedad_get_favorites');
    ids.forEach(id=>formData.append('ids[]', id));
    fetch(window.gravedadAjax.url,{method:'POST', body:formData})
      .then(r=>r.json())
      .then(res=>{
        if(res&&res.success&&res.data&&res.data.html){ favGrid.outerHTML='<div data-favorites-grid>'+res.data.html+'</div>'; updateFavUI(); if(typeof gravedadWrapLoopImages==='function') gravedadWrapLoopImages(); }
        else { favGrid.className='favorites-empty'; favGrid.innerHTML='<p>Esos productos ya no están disponibles.</p>'; }
      })
      .catch(()=>{ favGrid.innerHTML='<p>No se pudieron cargar los favoritos.</p>'; });
  });
})();

document.addEventListener('DOMContentLoaded',()=>{
  const menuButton=document.querySelector('.menu-toggle');
  const nav=document.querySelector('.main-nav');
  const navBackdrop=document.querySelector('.nav-backdrop');
  const navClose=document.querySelector('.nav-close');
  const goTop=document.querySelector('.go-top');

  function openNav(){
    if(!nav) return;
    nav.classList.add('is-open'); document.body.classList.add('menu-is-open');
    menuButton&&menuButton.setAttribute('aria-expanded','true');
  }
  function closeNav(){
    if(!nav) return;
    nav.classList.remove('is-open'); document.body.classList.remove('menu-is-open');
    menuButton&&menuButton.setAttribute('aria-expanded','false');
    nav.querySelectorAll('li.has-mega.is-open').forEach(li=>li.classList.remove('is-open'));
    nav.classList.remove('submenu-open');
  }
  menuButton&&menuButton.addEventListener('click',()=>{ nav&&nav.classList.contains('is-open') ? closeNav() : openNav(); });
  navBackdrop&&navBackdrop.addEventListener('click',closeNav);
  navClose&&navClose.addEventListener('click',closeNav);

  const searchToggle=document.querySelector('.mobile-search-toggle');
  const headerSearch=document.querySelector('.header-search');
  searchToggle&&headerSearch&&searchToggle.addEventListener('click',()=>{
    const isOpen=headerSearch.classList.toggle('is-open');
    searchToggle.classList.toggle('is-active',isOpen);
    searchToggle.setAttribute('aria-expanded',isOpen?'true':'false');
    if(isOpen){ const input=headerSearch.querySelector('input[type="search"]'); input&&input.focus(); }
  });
  document.addEventListener('click',(e)=>{
    if(!headerSearch||!headerSearch.classList.contains('is-open')) return;
    if(headerSearch.contains(e.target)||e.target===searchToggle||(searchToggle&&searchToggle.contains(e.target))) return;
    headerSearch.classList.remove('is-open');
    searchToggle&&(searchToggle.classList.remove('is-active'),searchToggle.setAttribute('aria-expanded','false'));
  });

  const searchInput=headerSearch&&headerSearch.querySelector('input[type="search"]');
  const searchSuggest=document.getElementById('search-suggest');
  if(searchInput&&searchSuggest&&window.gravedadAjax){
    let searchTimer=null, searchAbort=null, activeIndex=-1;
    function closeSuggest(){
      searchSuggest.hidden=true; searchSuggest.innerHTML='';
      searchInput.setAttribute('aria-expanded','false');
      activeIndex=-1;
    }
    function getItems(){ return Array.from(searchSuggest.querySelectorAll('.search-suggest-list a')); }
    function setActive(i){
      const items=getItems();
      if(!items.length) return;
      items.forEach(a=>a.classList.remove('is-active'));
      activeIndex=(i+items.length)%items.length;
      items[activeIndex].classList.add('is-active');
      items[activeIndex].scrollIntoView({block:'nearest'});
    }
    function runSearch(term){
      if(searchAbort) searchAbort.abort();
      searchAbort=new AbortController();
      const url=window.gravedadAjax.url+'?action=gravedad_search_products&term='+encodeURIComponent(term);
      fetch(url,{signal:searchAbort.signal})
        .then(r=>r.json())
        .then(res=>{
          if(!res||!res.success) return;
          if(!res.data.html){ closeSuggest(); return; }
          let html=res.data.html;
          if(res.data.count>6){ html+='<a class="search-suggest-more" href="'+headerSearch.getAttribute('action')+'?s='+encodeURIComponent(term)+'&post_type=product">Ver los '+res.data.count+' resultados para "'+term+'" →</a>'; }
          searchSuggest.innerHTML=html;
          searchSuggest.hidden=false;
          searchInput.setAttribute('aria-expanded','true');
          activeIndex=-1;
        })
        .catch(()=>{});
    }
    searchInput.addEventListener('input',()=>{
      const term=searchInput.value.trim();
      clearTimeout(searchTimer);
      if(term.length<2){ closeSuggest(); return; }
      searchTimer=setTimeout(()=>runSearch(term),300);
    });
    searchInput.addEventListener('keydown',(e)=>{
      const items=getItems();
      if(e.key==='ArrowDown'&&items.length){ e.preventDefault(); setActive(activeIndex+1); }
      else if(e.key==='ArrowUp'&&items.length){ e.preventDefault(); setActive(activeIndex-1); }
      else if(e.key==='Enter'&&activeIndex>-1&&items[activeIndex]){ e.preventDefault(); window.location.href=items[activeIndex].href; }
      else if(e.key==='Escape'){ closeSuggest(); }
    });
    searchInput.addEventListener('focus',()=>{ if(searchInput.value.trim().length>=2&&searchSuggest.innerHTML) searchSuggest.hidden=false; });
    document.addEventListener('click',(e)=>{
      if(searchSuggest.contains(e.target)||e.target===searchInput) return;
      closeSuggest();
    });
  }
  const footerGlow=document.querySelector('[data-footer-glow]');
  if(footerGlow){
    footerGlow.addEventListener('pointermove',(e)=>{
      const r=footerGlow.getBoundingClientRect();
      const x=((e.clientX-r.left)/r.width*100).toFixed(2);
      const y=((e.clientY-r.top)/r.height*100).toFixed(2);
      footerGlow.style.setProperty('--footer-x',x+'%');
      footerGlow.style.setProperty('--footer-y',y+'%');
    });
  }

  document.querySelectorAll('.footer-nav-toggle-btn').forEach(btn=>{
    btn.addEventListener('click',()=>{
      const parent=btn.closest('.footer-nav');
      if(!parent) return;
      const isOpen=parent.classList.toggle('is-open');
      btn.setAttribute('aria-expanded',isOpen?'true':'false');
    });
  });

  function closeSubmenu(){
    nav.querySelectorAll('li.has-mega.is-open').forEach(li=>li.classList.remove('is-open'));
    nav.classList.remove('submenu-open');
  }
  nav&&nav.querySelectorAll('li.has-mega > a').forEach(link=>{
    link.addEventListener('click',(e)=>{
      if(window.innerWidth>950) return;
      const li=link.parentElement;
      if(!li.classList.contains('is-open')){
        e.preventDefault();
        nav.querySelectorAll('li.has-mega.is-open').forEach(other=>{ if(other!==li) other.classList.remove('is-open'); });
        li.classList.add('is-open');
        nav.classList.add('submenu-open');
        const mega=li.querySelector('.mega-menu');
        if(mega&&!mega.querySelector('.mega-back')){
          const back=document.createElement('button');
          back.type='button'; back.className='mega-back';
          back.innerHTML='<span>‹</span> Volver al menú';
          back.addEventListener('click',closeSubmenu);
          mega.insertBefore(back, mega.firstChild);
        }
      }
    });
  });
  document.querySelectorAll('.main-nav a:not(li.has-mega > a)').forEach(link=>link.addEventListener('click',closeNav));

  const cartDrawer=document.querySelector('[data-cart-drawer]');
  const cartToggles=document.querySelectorAll('.header-cart, .floating-cart');
  let cartReturnFocus=null;
  function openCartDrawer(){
    if(!cartDrawer) return;
    cartReturnFocus=document.activeElement;
    cartDrawer.hidden=false; document.body.classList.add('cart-drawer-open');
    cartToggles.forEach(t=>t.setAttribute('aria-expanded','true'));
  }
  function closeCartDrawer(){
    if(!cartDrawer) return;
    cartDrawer.hidden=true; document.body.classList.remove('cart-drawer-open');
    cartToggles.forEach(t=>t.setAttribute('aria-expanded','false'));
    if(cartReturnFocus&&cartReturnFocus.focus) cartReturnFocus.focus();
  }
  if(cartDrawer){
    cartToggles.forEach(t=>t.addEventListener('click',(e)=>{ e.preventDefault(); openCartDrawer(); }));
    cartDrawer.querySelectorAll('[data-cart-close]').forEach(btn=>btn.addEventListener('click',closeCartDrawer));
    if(window.jQuery){ window.jQuery(document.body).on('added_to_cart',()=>openCartDrawer()); }
  }
  const updateTop=()=>goTop?.classList.toggle('is-visible',window.scrollY>500);
  window.addEventListener('scroll',updateTop,{passive:true}); updateTop();
  goTop?.addEventListener('click',()=>window.scrollTo({top:0,behavior:'smooth'}));
  initSinglesFilterAjax();
  function initSinglesFilterAjax(){
    const layout=document.querySelector('.singles-layout');
    const toolbar=document.querySelector('.singles-toolbar');
    if(!layout) return;

    function buildFilterUrl(form){
      const params=new URLSearchParams();
      for(const [key,value] of new FormData(form).entries()){
        if(value==='') continue;
        if(key==='post_type') continue;
        params.append(key,value);
      }
      if(params.has('s')) params.set('post_type','product');
      const qs=params.toString();
      return form.action+(qs?(form.action.includes('?')?'&':'?')+qs:'');
    }

    let swapSeq=0, swapAbort=null;
    function swapTo(url,pushState){
      // Cada pedido lleva su número de orden: si se eligen filtros rápido,
      // una respuesta vieja puede llegar después de una nueva y dejar la
      // pantalla desincronizada (los chips con los filtros elegidos pero la
      // grilla y el contador con el resultado anterior). Solo aplicamos la
      // respuesta del último pedido, y cancelamos los anteriores.
      const seq=++swapSeq;
      if(swapAbort) swapAbort.abort();
      swapAbort=new AbortController();
      // Buscamos la grilla y la barra EN CADA pedido: quedaron guardadas al
      // inicializar, pero cada recambio las reemplaza por nodos nuevos, así
      // que a partir del segundo filtro se escribía sobre elementos que ya
      // no estaban en la página y la grilla/contador se quedaban clavados
      // en el primer resultado.
      const layoutNow=document.querySelector('.singles-layout');
      const toolbarNow=document.querySelector('.singles-toolbar');
      if(layoutNow) layoutNow.style.opacity='.5';
      fetch(url,{headers:{'X-Requested-With':'XMLHttpRequest'},signal:swapAbort.signal})
        .then(r=>r.text())
        .then(html=>{
          if(seq!==swapSeq) return;
          const doc=new DOMParser().parseFromString(html,'text/html');
          const wasOpen=document.querySelector('.singles-filters')?.classList.contains('is-open');

          // La cabecera también se actualiza: si no, al buscar de nuevo desde
          // el panel lateral los resultados cambiaban pero el título grande
          // seguía mostrando el término anterior y parecía que no había pasado
          // nada. Lo mismo con el buscador de la barra superior.
          const newHero=doc.querySelector('.singles-hero');
          const oldHero=document.querySelector('.singles-hero');
          if(newHero&&oldHero){ oldHero.replaceWith(newHero); }
          const newRefine=doc.querySelector('.search-refine input[name="s"]');
          const oldRefine=document.querySelector('.search-refine input[name="s"]');
          if(newRefine&&oldRefine){ oldRefine.value=newRefine.value; }

          const newLayout=doc.querySelector('.singles-layout');
          if(newLayout&&layoutNow){ layoutNow.replaceWith(newLayout); }
          const newToolbar=doc.querySelector('.singles-toolbar');
          if(newToolbar&&toolbarNow){ toolbarNow.replaceWith(newToolbar); }
          const newChips=doc.querySelector('.active-filters');
          const oldChips=document.querySelector('.active-filters');
          if(newChips&&oldChips){ oldChips.replaceWith(newChips); }
          else if(newChips&&!oldChips&&newToolbar){ newToolbar.insertAdjacentElement('afterend',newChips); }
          else if(!newChips&&oldChips){ oldChips.remove(); }

          const freshFilters=document.querySelector('.singles-filters');
          if(freshFilters&&wasOpen) freshFilters.classList.add('is-open');

          if(pushState) window.history.pushState({gravedadFilter:true},'',url);
          document.title=doc.title;
          bindFilterEvents();
          if(typeof gravedadWrapLoopImages==='function') gravedadWrapLoopImages();
        })
        .catch((err)=>{ if(err&&err.name==='AbortError') return; window.location.href=url; });
    }

    function bindFilterEvents(){
      const layoutEl=document.querySelector('.singles-layout');
      const toolbarEl=document.querySelector('.singles-toolbar');
      if(!layoutEl) return;
      layoutEl.style.opacity='';

      layoutEl.querySelectorAll('.singles-filters form select').forEach(select=>{
        select.addEventListener('change',()=>{ swapTo(buildFilterUrl(select.form),true); });
      });
      layoutEl.querySelectorAll('.singles-filters form').forEach(form=>{
        form.addEventListener('submit',(e)=>{ e.preventDefault(); swapTo(buildFilterUrl(form),true); });
      });
      layoutEl.querySelectorAll('.active-filters a, .singles-filters .filter-heading a').forEach(link=>{
        link.addEventListener('click',(e)=>{ e.preventDefault(); swapTo(link.href,true); });
      });
      const activeFiltersEl=document.querySelector('.active-filters');
      activeFiltersEl?.querySelectorAll('a').forEach(link=>{
        link.addEventListener('click',(e)=>{ e.preventDefault(); swapTo(link.href,true); });
      });
      toolbarEl?.querySelectorAll('.singles-order select').forEach(select=>{
        select.addEventListener('change',()=>{
          const form=select.closest('form')||select.form;
          const currentParams=new URLSearchParams(window.location.search);
          currentParams.set('orderby',select.value);
          currentParams.delete('post_type');
          const qs=currentParams.toString();
          const url=form?buildFilterUrl(form):(window.location.pathname+(qs?'?'+qs:''));
          swapTo(url,true);
        });
      });

      const filterButtonEl=document.querySelector('.singles-filter-toggle');
      const filtersEl=document.querySelector('.singles-filters');
      filterButtonEl&&filtersEl&&!filterButtonEl.dataset.bound&&(filterButtonEl.dataset.bound='1',filterButtonEl.addEventListener('click',()=>{const open=filtersEl.classList.toggle('is-open');filterButtonEl.setAttribute('aria-expanded',String(Boolean(open)))}));
    }
    bindFilterEvents();

    window.addEventListener('popstate',()=>{ swapTo(window.location.href,false); });
  }

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
    if(input.type==='hidden'){ wrap.style.display='none'; return; }
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
    const scrollByCard=(dir)=>{ gravedadSmoothScrollTo(track, Math.max(0,Math.min(track.scrollLeft+dir*cardStep(), maxScroll())), 950); };

    let timer=null;
    const advance=()=>{ if(atEnd()){ gravedadSmoothScrollTo(track,0,1100); } else { scrollByCard(1); } };
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
        d.addEventListener('click',()=>{ stop(); gravedadSmoothScrollTo(track, Math.min(i*perPage()*cardStep(), maxScroll()), 850); start(); });
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

document.addEventListener('DOMContentLoaded',()=>{
  if(!document.body.classList.contains('woocommerce-checkout')) return;
  function cleanNotices(){
    document.querySelectorAll('.woocommerce-message, .woocommerce-info').forEach(el=>{
      if(/zona de coincidencia/i.test(el.textContent)) el.remove();
    });
  }
  cleanNotices();
  if(window.jQuery){ window.jQuery(document.body).on('updated_checkout',cleanNotices); }
  new MutationObserver(cleanNotices).observe(document.body,{childList:true,subtree:true});
});

document.addEventListener('DOMContentLoaded',()=>{
  const heroWrap=document.querySelector('.hero-slider-wrap');
  if(!heroWrap) return;
  const track=heroWrap.querySelector('.hero-slider-track');
  const slides=[...track.querySelectorAll('.hero-slide')];
  const dotsWrap=heroWrap.querySelector('[data-hero-slider-dots]');
  if(slides.length<2||!dotsWrap) return;

  const reduceMotion=window.matchMedia('(prefers-reduced-motion: reduce)').matches;
  const slideWidth=()=>track.clientWidth;
  const maxScroll=()=>track.scrollWidth-track.clientWidth;
  const currentIndex=()=>Math.round(track.scrollLeft/slideWidth());
  const goTo=(i)=>{ gravedadSmoothScrollTo(track, Math.max(0,Math.min(i*slideWidth(),maxScroll())), 700); };

  let dotEls=[];
  const syncDots=()=>{ const idx=Math.min(currentIndex(),dotEls.length-1); dotEls.forEach((d,i)=>d.classList.toggle('is-active', i===idx)); };
  const buildDots=()=>{
    dotsWrap.innerHTML=''; dotEls=[];
    slides.forEach((_,i)=>{
      const d=document.createElement('button'); d.type='button'; d.className='carousel-dot'; d.setAttribute('aria-label','Ir al slide '+(i+1));
      d.addEventListener('click',()=>{ stop(); goTo(i); start(); });
      dotsWrap.appendChild(d); dotEls.push(d);
    });
    syncDots();
  };

  let timer=null;
  const advance=()=>{ goTo((currentIndex()+1)%slides.length); };
  const start=()=>{ if(reduceMotion) return; stop(); timer=setInterval(advance,6500); };
  const stop=()=>{ if(timer){ clearInterval(timer); timer=null; } };

  const prevBtn=document.createElement('button'); prevBtn.type='button'; prevBtn.className='carousel-arrow prev'; prevBtn.innerHTML='‹'; prevBtn.setAttribute('aria-label','Slide anterior');
  const nextBtn=document.createElement('button'); nextBtn.type='button'; nextBtn.className='carousel-arrow next'; nextBtn.innerHTML='›'; nextBtn.setAttribute('aria-label','Slide siguiente');
  heroWrap.appendChild(prevBtn); heroWrap.appendChild(nextBtn);
  prevBtn.addEventListener('click',()=>{ stop(); goTo((currentIndex()-1+slides.length)%slides.length); start(); });
  nextBtn.addEventListener('click',()=>{ stop(); goTo((currentIndex()+1)%slides.length); start(); });

  track.addEventListener('scroll',()=>{ clearTimeout(track._dotTimer); track._dotTimer=setTimeout(syncDots,80); },{passive:true});
  window.addEventListener('resize',()=>{ clearTimeout(heroWrap._resizeTimer); heroWrap._resizeTimer=setTimeout(()=>goTo(currentIndex()),200); });
  heroWrap.addEventListener('mouseenter',stop);
  heroWrap.addEventListener('mouseleave',start);
  heroWrap.addEventListener('touchstart',stop,{passive:true});
  heroWrap.addEventListener('touchend',start);

  buildDots();
  start();
});

// La estrellita de favoritos, en la grilla estándar de WooCommerce
// (categorías, tienda, búsqueda), comparte el mismo <a> gigante que
// envuelve imagen + título + precio, así que no se puede anclar solo
// a la imagen con CSS. La envolvemos en su propio contenedor. Se expone
// como función porque los filtros de "Cartas sueltas" vuelven a dibujar
// las tarjetas por AJAX y hay que aplicarlo también a las nuevas.
function gravedadWrapLoopImages(){
  document.querySelectorAll('ul.products li.product .fav-toggle').forEach(btn=>{
    const link=btn.closest('a.woocommerce-loop-product__link, a.woocommerce-LoopProduct-link');
    const img=link?link.querySelector('img'):null;
    if(!img||img.parentElement.classList.contains('loop-product-image')) return;
    const wrap=document.createElement('span');
    wrap.className='loop-product-image';
    img.parentNode.insertBefore(wrap,img);
    wrap.appendChild(img);
    // La segunda foto (la que aparece al pasar el mouse) tiene que quedar
    // dentro del mismo contenedor para poder superponerse a la principal.
    const hover=link.querySelector('.product-image-hover');
    if(hover) wrap.appendChild(hover);
    // La cápsula FOIL también va adentro, para poder anclarla a la esquina
    // de la imagen y que no se superponga con la estrella de favoritos.
    const foil=link.querySelector('.foil-badge');
    if(foil) wrap.appendChild(foil);
    wrap.appendChild(btn);
  });
}
document.addEventListener('DOMContentLoaded',gravedadWrapLoopImages);

window.addEventListener('load',()=>{
  // Botón de lupa sobre la foto del producto: al tocarlo abre la imagen
  // ampliada reenviando el clic al enlace de la foto activa, que es lo que
  // WooCommerce ya tiene conectado a su visor. Va dentro de .flex-viewport
  // (la ventana visible), no del carril que se desliza, para que no se
  // mueva al cambiar de foto.
  const host=document.querySelector('.woocommerce div.product .flex-viewport')
          || document.querySelector('.woocommerce div.product .woocommerce-product-gallery');
  if(!host||host.querySelector('.gravedad-zoom-btn')) return;
  const btn=document.createElement('button');
  btn.type='button';
  btn.className='gravedad-zoom-btn';
  btn.setAttribute('aria-label','Ver la imagen más grande');
  btn.innerHTML='<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="7"></circle><line x1="16.5" y1="16.5" x2="21" y2="21"></line><line x1="11" y1="8" x2="11" y2="14"></line><line x1="8" y1="11" x2="14" y2="11"></line></svg>';
  btn.addEventListener('click',e=>{
    e.preventDefault();
    const link=document.querySelector('.woocommerce-product-gallery__image.flex-active-slide a')
            || document.querySelector('.woocommerce-product-gallery__image a');
    if(link) link.click();
  });
  host.appendChild(btn);
});

document.addEventListener('DOMContentLoaded',()=>{
  // En el checkout, WooCommerce mueve el scroll por su cuenta al cambiar de
  // medio de pago (y la página cambia de alto cuando se despliega el cartel
  // del medio elegido). Con el desplazamiento suave del sitio ese movimiento
  // se exagera y termina llevando la vista al final de la página, así que
  // acá lo dejamos instantáneo.
  if(document.body.classList.contains('woocommerce-checkout')){
    document.documentElement.style.scrollBehavior='auto';
  }
});

window.addEventListener('load',()=>{
  // Arrastrar la foto del producto con el mouse para pasar a la otra: FlexSlider
  // ya soporta el gesto táctil de fábrica (touch:true por defecto), así que esto
  // suma únicamente el arrastre con mouse, que la librería no trae en escritorio.
  // Va en window.load (no DOMContentLoaded): el carril de miniaturas lo arma el
  // propio script de WooCommerce, que puede terminar después del DOMContentLoaded,
  // y si en ese momento todavía no había 2 miniaturas el arrastre no se activaba.
  const gallery=document.querySelector('.woocommerce-product-gallery');
  const viewport=gallery?gallery.querySelector('.flex-viewport'):null;
  const thumbs=()=>gallery?[...gallery.querySelectorAll('.flex-control-nav li img')]:[];
  if(!viewport||thumbs().length<2) return;

  const THRESHOLD=40;
  let startX=0,dragging=false,moved=false;

  function activeIndex(){
    const slides=[...gallery.querySelectorAll('.woocommerce-product-gallery__image')];
    return Math.max(0,slides.findIndex(s=>s.classList.contains('flex-active-slide')));
  }
  function goTo(index){
    const list=thumbs();
    const clamped=Math.max(0,Math.min(list.length-1,index));
    if(clamped!==activeIndex()) list[clamped].click();
  }

  viewport.style.cursor='grab';
  viewport.addEventListener('mousedown',e=>{
    dragging=true; moved=false; startX=e.clientX;
    viewport.style.cursor='grabbing';
  });
  window.addEventListener('mousemove',e=>{
    if(!dragging) return;
    if(Math.abs(e.clientX-startX)>6) moved=true;
  });
  window.addEventListener('mouseup',e=>{
    if(!dragging) return;
    dragging=false;
    viewport.style.cursor='grab';
    const dx=e.clientX-startX;
    if(dx<=-THRESHOLD) goTo(activeIndex()+1);
    else if(dx>=THRESHOLD) goTo(activeIndex()-1);
  });
  viewport.addEventListener('mouseleave',()=>{
    if(dragging){ dragging=false; viewport.style.cursor='grab'; }
  });
  // Si hubo arrastre, que el click no dispare la lupa (el link que agranda
  // la foto), para que soltar después de arrastrar no abra el visor.
  gallery.addEventListener('click',e=>{
    if(moved&&e.target.closest('.woocommerce-product-gallery__image a')){
      e.preventDefault(); e.stopPropagation();
    }
    moved=false;
  },true);
});
