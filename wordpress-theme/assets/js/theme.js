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
});
