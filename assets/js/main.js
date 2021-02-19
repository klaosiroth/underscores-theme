(() => {

  function noscroll() {
    const btnElem = document.querySelector('.menu-toggle');

    btnElem.addEventListener('click', function() { // on every click
      const bodyElem = document.querySelector('body');
      const siteNavigation = document.querySelector('#site-navigation');
      const isToggled = siteNavigation.classList.contains('toggled');

      if (isToggled) { // on .open-menu click
        bodyElem.classList.add('no-scroll');
      } else { // on close-menu click
        bodyElem.classList.remove('no-scroll');
      }
      console.log('It was clicked!'); // Check function onClick()
    });
    
  }

  function run() {
    console.log('%c Happy Coding...', 'font-size: 1rem; font-weight: bold; color: #c02d2e;');
    noscroll();
  };

  run();
  
})();