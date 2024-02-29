/**
* Template Name: ComingSoon
* Updated: Sep 28 2023 with Bootstrap v5.3.2
* Template URL: https://bootstrapmade.com/comingsoon-free-html-bootstrap-template/
* Author: BootstrapMade.com
* License: https://bootstrapmade.com/license/
*/
(function() {
  "use strict";

  /**
   * Easy selector helper function
   */
  const select = (el, all = false) => {
    el = el.trim()
    if (all) {
      return [...document.querySelectorAll(el)]
    } else {
      return document.querySelector(el)
    }
  }

  /**
   * Easy event listener function
   */
  const on = (type, el, listener, all = false) => {
    let selectEl = select(el, all)
    if (selectEl) {
      if (all) {
        selectEl.forEach(e => e.addEventListener(type, listener))
      } else {
        selectEl.addEventListener(type, listener)
      }
    }
  }

  /**
   * Easy on scroll event listener 
   */
  const onscroll = (el, listener) => {
    el.addEventListener('scroll', listener)
  }

  /**
   * Back to top button
   */
  let backtotop = select('.back-to-top')
  if (backtotop) {
    const toggleBacktotop = () => {
      if (window.scrollY > 100) {
        backtotop.classList.add('active')
      } else {
        backtotop.classList.remove('active')
      }
    }
    window.addEventListener('load', toggleBacktotop)
    onscroll(document, toggleBacktotop)
  }



  /**
   * Countdown timer
   */
  let countdown = [];
  //tabla de asignacion de objeto
  let idIxLapse={'tl1':0,'tl2':1,'dl1':2,'dl2':3};
  let idLapses=['tl1','tl2','dl1','dl2'];

  countdown[idIxLapse[idLapses[0]]]=select('.timeLapse1');
  countdown[idIxLapse[idLapses[1]]]=select('.timeLapse2');
  countdown[idIxLapse[idLapses[2]]]=select('.dataLapse1');
  countdown[idIxLapse[idLapses[3]]]=select('.dataLapse2');
  const salida = [
    countdown[idIxLapse[idLapses[0]]].innerHTML,
    countdown[idIxLapse[idLapses[1]]].innerHTML,
    countdown[idIxLapse[idLapses[2]]].innerHTML,
    countdown[idIxLapse[idLapses[3]]].innerHTML
  ];
  //Tablas de asignacion de datos
  let obj =["email","login","contacto","obj4","obj5","obj6","obj7","obj8","obj9","obj10","obj11","obj12","obj13","obj14","obj15","obj16","obj17","obj18","obj19","obj20","obj21","obj22","obj23","obj24","obj25","obj26","obj27","obj28","obj29","obj30","obj31","obj32","obj33","obj34","obj35","obj36","obj37","obj38","obj39","obj40","obj41","obj42","obj43","obj44","obj45","obj46","obj47","obj48","obj49","obj50","obj51","obj52","obj53","obj54","obj55","obj56","obj57","obj58","obj59","obj60"];
  let tem =["php","JavaScript","json","MySql","SQL","Redes","Topologias","Sockets","protocolos","sistemas","admin","tecnica","servers","clientes","nube","virt-lib","minima accion","identidad","integracion","transporte","carga","Peticion de Servicio","DDoS","C","C++","Java","Python","Kernel","operativos","Modelo","Visual","Controlador","MongoDB","Cadena de Bloques","Cifrado","Encriptado","Senial","Fourier","Hooks","Matrices","POO","POE","POP","Paradigmas","Asm","Turing","Vonn Newman","Rele","Flip Flop","Filtros","Electronica Digital","Bus","Ancho de banda","ADSL","Fibra Optica","Ethernet","Modem","Switch","Hub","Router"];
  let sec =["sec1","sec2","sec3","sec4","sec5","sec6","sec7","sec8","sec9","sec10","sec11","sec12","sec13","sec14","sec15","sec16","sec17","sec18","sec19","sec20","sec21","sec22","sec23","sec24","sec25","sec26","sec27","sec28","sec29","sec30","sec31","sec32","sec33","sec34","sec35","sec36","sec37","sec38","sec39","sec40","sec41","sec42","sec43","sec44","sec45","sec46","sec47","sec48","sec49","sec50","sec51","sec52","sec53","sec54","sec55","sec56","sec57","sec58","sec59","sec60"];
  let eje =["eje1","eje2","eje3","eje4","eje5","eje6","eje7","eje8","eje9","eje10","eje11","eje12","eje13","eje14","eje15","eje16","eje17","eje18","eje19","eje20","eje21","eje22","eje23","eje24","eje25","eje26","eje27","eje28","eje29","eje30","eje31","eje32","eje33","eje34","eje35","eje36","eje37","eje38","eje39","eje40","eje41","eje42","eje43","eje44","eje45","eje46","eje47","eje48","eje49","eje50","eje51","eje52","eje53","eje54","eje55","eje56","eje57","eje58","eje59","eje60"];
  
  const countDownDate = function() {
    let timeleft = [];
//asignacion de objetos
    timeleft[idIxLapse[idLapses[0]]] = new Date(countdown[[idIxLapse[idLapses[0]]]].getAttribute('data-count')).getTime() - new Date().getTime();
    timeleft[idIxLapse[idLapses[1]]] = new Date(countdown[[idIxLapse[idLapses[1]]]].getAttribute('data-count')).getTime() - new Date().getTime();
    timeleft[idIxLapse[idLapses[2]]] = new Date(countdown[[idIxLapse[idLapses[2]]]].getAttribute('data-count')).getTime() - new Date().getTime();

    function stepByStep(timeleft){
      let iiT= {
        's':-1*(Math.floor((timeleft % (1000 * 60)) / 1000)),
        'm':-1*(Math.floor((timeleft % (1000 * 60 * 60)) / (1000 * 60))),
        'h':-1*(Math.floor((timeleft % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60))),
        'd':-1*(Math.floor(timeleft / (1000 * 60 * 60 * 24)))
      };
      return iiT;
    }
    let time1 = stepByStep(timeleft[idIxLapse[idLapses[0]]]);
    let time2 = stepByStep(timeleft[idIxLapse[idLapses[1]]]);
    let time3 = stepByStep(timeleft[idIxLapse[idLapses[2]]]);

    //asignacion de datos
    let leyenda = [obj[time3['s']], tem[time3['s']], sec[time3['s']], eje[time3['s']]];
    countdown[idIxLapse[idLapses[0]]].innerHTML = salida[idIxLapse[idLapses[0]]].replace('%tl1a', time1['d']).replace('%tl1b', time1['h']).replace('%tl1c', time1['m']).replace('%tl1d', time1['s']);
    countdown[idIxLapse[idLapses[1]]].innerHTML = salida[idIxLapse[idLapses[1]]].replace('%tl2a', time2['d']).replace('%tl2b', time2['h']).replace('%tl2c', time2['m']).replace('%tl2d', time2['s']);
    countdown[idIxLapse[idLapses[2]]].innerHTML = salida[idIxLapse[idLapses[2]]].replace('%dl1a', leyenda[0]).replace('%dl1b', leyenda[1]).replace('%dl1c', leyenda[2]).replace('%dl1d', leyenda[3]);
  }
  countDownDate();
  setInterval(countDownDate, 1000);
  const tactac = function() {
    function utf8_to_b64(str) {
      return btoa(str);
    }
    
    function b64_to_utf8(str) {
      return decodeURIComponent(escape(atob(str)));
    }
    //decodeURIComponent
    let dataTac={'uno':'KzM0IDY4MiAxNTMgNDk0fCszNCAwMDAgMDAwIDAwMA=='};
    let tac = [];
    let strIn=countdown[idIxLapse[idLapses[3]]].getAttribute('data-tac1');
    let strOut=b64_to_utf8(dataTac[strIn]);
    tac=strOut.split("|");
    countdown[idIxLapse[idLapses[3]]].innerHTML = salida[idIxLapse[idLapses[3]]].replace('%dl2a', tac[0]).replace('%dl2b', tac[1]);
  }
  tactac();
  //tacleft[idIxLapse[idLapses[3]]] = new Date(countdown[[idIxLapse[idLapses[3]]]].getAttribute('data-tac1'));//.getTime() - new Date().getTime();

})()

