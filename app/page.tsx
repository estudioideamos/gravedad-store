"use client";
import { useState } from "react";

const games=[
 ['/logo-magic.svg','Magic','magic'],
 ['/logo-pokemon.svg','Pokémon','pokemon'],
 ['/logo-onepiece.jpg','One Piece','onepiece'],
 ['/logo-digimon.png','Digimon','digimon'],
 ['/logo-dragonball.png','Dragon Ball','dragonball'],
 ['', 'Juegos de mesa','boardgames']
];
const products=[
 ['PREVENTA','Magic · Tarkir: Dragonstorm','Play Booster Box · Inglés','$ 289.900','magic'],
 ['NUEVO','Pokémon · Destined Rivals','Elite Trainer Box · Inglés','$ 159.500','pokemon'],
 ['ÚLTIMAS','One Piece · OP-11','Booster Box · Inglés','$ 124.900','onepiece'],
 ['OFERTA','Dragon Shield · Dual Matte','Sleeves Standard · 100u','$ 18.900','shield']
];
const Arrow=()=> <svg viewBox="0 0 24 24"><path d="M4 12h15M14 6l6 6-6 6"/></svg>;
const Search=()=> <svg viewBox="0 0 24 24"><circle cx="10" cy="10" r="6"/><path d="m15 15 5 5"/></svg>;

export default function Home(){
 const [menu,setMenu]=useState(false); const [cart,setCart]=useState(0);
 const assetBase=process.env.NEXT_PUBLIC_BASE_PATH ?? '';
 const assetOrigin=assetBase ? 'https://gravedad-store.r-lavega.chatgpt.site' : '';
 return <main>
  <div className="top"><span>ENVÍOS A TODO EL PAÍS</span><span>3 CUOTAS SIN INTERÉS EN PRODUCTOS SELECCIONADOS</span><a href="https://instagram.com/gravedadstore">@GRAVEDADSTORE ↗</a></div>
  <header><button className="hamb" onClick={()=>setMenu(!menu)}><i/><i/></button><a className="logo" href="#"><i/><strong>GRAVEDAD</strong><small>STORE</small></a><label className="search"><Search/><input placeholder="Buscá cartas, juegos, colecciones..."/><kbd>⌘ K</kbd></label><div className="actions"><button>♙</button><button className="cart">▱<b>{cart}</b></button></div></header>
  <nav className={menu?'open':''}>{['TCG','Cartas sueltas','Juegos de mesa','Accesorios','Preventas','Novedades','Ofertas','Eventos'].map(x=><a key={x} href={`#${x==='Eventos'?'eventos':'productos'}`} className={x==='Ofertas'?'hot':''}>{x}{['TCG','Cartas sueltas','Juegos de mesa','Accesorios'].includes(x)&&<small>⌄</small>}</a>)}</nav>
  <section className="hero"><div className="grid"/><div className="heroCopy"><span className="eyebrow"><i/> TODO TU UNIVERSO TCG</span><h1>Entrá en<br/><em>otra dimensión.</em></h1><p>Cartas, juegos y accesorios para quienes no vienen solamente a jugar.</p><div><a className="btn primary" href="#productos">Explorar novedades <Arrow/></a><a className="btn secondary" href="#juegos">Ver cartas sueltas</a></div></div><div className="heroImage" style={{backgroundImage:`linear-gradient(90deg,#090a0c 0%,rgba(9,10,12,.98) 25%,rgba(9,10,12,.3) 62%,rgba(9,10,12,.08)),url('${assetOrigin}/hero-gravedad.png')`}}/><div className="scroll">DESLIZÁ PARA EXPLORAR <i/></div></section>
  <section className="choose" id="juegos"><p className="label"><b>01</b> ELEGÍ TU JUEGO</p><div className="games">{games.map((g,i)=><a href="#productos" className={`game g${i}`} key={g[1]}>{g[0]?<img className={`gameLogo ${g[2]}`} src={`${assetOrigin}${g[0]}`} alt={`Logo ${g[1]}`}/>:<span className="diceLogo" aria-hidden="true"><i>⚄</i><i>⚂</i></span>}<strong>{g[1]}</strong><b>→</b></a>)}</div></section>
  <section className="products" id="productos"><div className="sectionHead"><div><p className="label">RECIÉN LLEGADOS</p><h2>Novedades que<br/><em>atraen miradas.</em></h2></div><a href="#">VER TODOS LOS PRODUCTOS <Arrow/></a></div><div className="productGrid">{products.map((p)=><article key={p[1]}><div className={`productArt ${p[4]}`}><span>{p[0]}</span><button>♡</button><div className="pack"><i/><b>{p[4]==='shield'?'DS':p[1].split(' · ')[0]}</b><small>TRADING CARD GAME</small></div></div><div className="productInfo"><small>{p[2]}</small><h3>{p[1]}</h3><div><strong>{p[3]}</strong><button onClick={()=>setCart(cart+1)}>+</button></div></div></article>)}</div></section>
  <section className="categories">{[
   ['✦','MILES DE OPCIONES','Cartas sueltas','Buscá por juego, colección, rareza, idioma, condición y más.'],
   ['◈','ABRÍ. JUGÁ. COLECCIONÁ.','Productos sellados','Sobres, booster boxes, bundles, mazos y ediciones especiales.'],
   ['⬡','PARA COMPARTIR LA MESA','Juegos de mesa','Estrategia, party games, cooperativos, familiares y mucho más.']
  ].map(c=><a href="#" key={c[2]}><b className="catIcon">{c[0]}</b><div><small>{c[1]}</small><h3>{c[2]}</h3><p>{c[3]}</p><strong>EXPLORAR <Arrow/></strong></div><i className="shape"/></a>)}</section>
  <section className="event" id="eventos"><div className="eventVisual"><div className="grid"/><time><b>24</b><span>AGO</span></time><div className="eventCard"><i/><b>GRAVEDAD</b><small>STORE CHAMPIONSHIP</small></div></div><div className="eventCopy"><p className="label">PRÓXIMO EVENTO</p><h2>La comunidad<br/>también <em>juega.</em></h2><p>Vení a competir, intercambiar y compartir con otros jugadores. Torneos, lanzamientos y encuentros en nuestro local.</p><div className="meta"><span>⌖ José C. Paz, Buenos Aires</span><span>◷ 14:00 hs</span></div><a className="btn primary" href="https://wa.me/541136403287">Reservar mi lugar <Arrow/></a></div></section>
  <section className="benefits"><div><b>▱</b><span><strong>Envíos a todo el país</strong><small>Correo Argentino</small></span></div><div><b>◇</b><span><strong>Compra protegida</strong><small>Pagos seguros</small></span></div><div><b>◎</b><span><strong>Retiro en tienda</strong><small>Sin costo adicional</small></span></div><div><b>◫</b><span><strong>Atención personalizada</strong><small>Somos jugadores como vos</small></span></div></section>
  <section className="newsletter"><div><p className="label">NO TE QUEDES AFUERA</p><h2>Todo lo nuevo,<br/><em>directo a tu inbox.</em></h2></div><form onSubmit={e=>e.preventDefault()}><input type="email" placeholder="tu@email.com"/><button>QUIERO ENTERARME <Arrow/></button><small>Prometemos no spamear. Solo lanzamientos, preventas y eventos.</small></form></section>
  <footer><div className="brand"><a className="logo" href="#"><i/><strong>GRAVEDAD</strong><small>STORE</small></a><p>Tu punto de encuentro para jugar,<br/>coleccionar y descubrir.</p><a href="https://instagram.com/gravedadstore">Instagram ↗</a></div><div><b>TIENDA</b><a>TCG</a><a>Cartas sueltas</a><a>Juegos de mesa</a><a>Accesorios</a></div><div><b>AYUDA</b><a>Cómo comprar</a><a>Envíos</a><a>Cambios y devoluciones</a><a>Preguntas frecuentes</a></div><div><b>CONTACTO</b><a href="https://wa.me/541136403287">11 3640 3287</a><a href="mailto:silvafacu18@gmail.com.ar">silvafacu18@gmail.com.ar</a><span>José C. Paz, Buenos Aires</span></div><aside><span>© 2026 GRAVEDAD STORE</span><span>Diseño y desarrollo por <a href="https://ideamos.com.ar">IDEAMOS</a></span></aside></footer>
  <a className="wa" href="https://wa.me/541136403287">WA</a>
 </main>
}
