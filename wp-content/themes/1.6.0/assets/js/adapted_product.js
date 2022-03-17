/* global $*/
/* global wpgb*/
var $ = jQuery;

window.WP_Grid_Builder && WP_Grid_Builder.on('init', function(wpgb) {

  var productStep = $('.product-step');
  var productBottomStep = $('.product-bottom-step');
  var productItem = $('.product-bottom-step .project-filter-card');

  function removeActiveClass(element) {
    element.each(function() {
      $(this).removeClass('active');
    });
  }


  const breakpoint = window.matchMedia('(max-width:480px)');

  function showPrevious() {
    if (breakpoint.matches) {
      (currentIndex > 0) ? $('.mobile-previous').fadeIn(): $('.mobile-previous').fadeOut();
    }
  }
  showPrevious(breakpoint);
  breakpoint.addListener(showPrevious);



  var currentIndex = 0;
  //STEP HANDLER
  productStep.each(function(index) {
    $(this).on('click', function() {
      removeActiveClass(productStep);
      removeActiveClass(productBottomStep);
      $(this).addClass('active');
      productBottomStep.eq(index).addClass('active');
      currentIndex = index;

      switch (currentIndex) {
        case 0:
          wpgb.facets.reset(['product_support', 'product_surface', 'product_materials', 'product_gamme']);
          break;
        case 1:
          wpgb.facets.reset(['product_surface']);
          break;
        case 2:
          wpgb.facets.reset(['product_materials']);
          break;
        case 3:
          wpgb.facets.reset(['product_gamme']);
          break;
      }
    });
  });

  //ITEM CLICK TO NEXT STEP
  productItem.each(function() {
    $(this).on('click', function() {
      var self = $(this);
      removeActiveClass(productStep);
      removeActiveClass(productBottomStep);
      currentIndex += 1;
      showPrevious();

      $('.wpgb-checkbox input').each(function() {
        if (self.data("slug") == $(this).val()) {
          $(this).parent().attr('tabindex', 0);
          $(this).parent().trigger('click');
        }
      });

      productStep.eq(currentIndex).addClass('active');
      productBottomStep.eq(currentIndex).addClass('active');

    });
  });

  //MOBILE BACKWARD HANDLER
  $('.mobile-previous').on('click', function() {
    //CHECK IF CURRENT ID IS ON STEP 1
    (currentIndex > 0) ? currentIndex -= 1: currentIndex = 0;
    removeActiveClass(productStep);
    removeActiveClass(productBottomStep);
    productStep.eq(currentIndex).addClass('active');
    productBottomStep.eq(currentIndex).addClass('active');
    showPrevious();

    //EMPTY FILTERS
    switch (currentIndex) {
      case 0:
        wpgb.facets.reset(['product_support', 'product_surface', 'product_materials', 'product_gamme']);
        break;
      case 1:
        wpgb.facets.reset(['product_surface']);
        break;
      case 2:
        wpgb.facets.reset(['product_materials']);
        break;
      case 3:
        wpgb.facets.reset(['product_gamme']);
        break;
    }
  });
  
  
  
  // // ON PRODUCT-LIST, UPDATE <title>, <meta-description> and <h1> on filter change
  if (document.body.classList.contains('page-template-template-page-liste-produits')) {
    const ORIGINAL_TITLE = document.querySelector('title').innerText
    const ORIGINAL_H1 = document.querySelector('h1').innerText
    
    const ucfirst = (str) => {
      return str.charAt(0).toUpperCase() + str.slice(1)
    }
    wpgb.facets.on('render', function( element, facet ) {
      if (7 == facet.id || 8 == facet.id) {
        
        const url_string = window.location.href
        const url = new URL(url_string)
        const activeGammes = url.searchParams.get("_product_gamme")?.split(',')
        const activeSupports = url.searchParams.get("_product_support")?.split(',')
        
        const $filterWrapper = document.querySelector('.listing-filter-block .filter-wrapper')
        
        let strGamme = ''
        if (activeGammes) {
          activeGammes.forEach(gammeSlug => {
            const gammeLabel = document.querySelector(`input[value="${gammeSlug}"] ~ .wpgb-checkbox-label`).textContent
            strGamme += `${ucfirst(gammeLabel)} et `
          })
          strGamme = strGamme.slice(0, -4)
        }
        
        let strSupport = ''
        if (activeSupports) {
          strSupport = ' pour '
          activeSupports.forEach(supportSlug => {
            const supportLabel = document.querySelector(`input[value="${supportSlug}"] ~ .wpgb-checkbox-label`).textContent
            strSupport += `${ucfirst(supportLabel)} et `
          })
          strSupport = strSupport.slice(0, -4)
        }
        
        document.querySelector('title').innerText = `${ORIGINAL_H1} ${strGamme} ${strSupport} | Guard Industrie`
        
        document.querySelector('h1').innerText = `${ORIGINAL_H1} ${strGamme} ${strSupport}`
        
        document.querySelector('meta[name="description"]').setAttribute("content", 
          `Découvrez ${ORIGINAL_H1.toLowerCase()} ${strGamme}${strSupport} hauts de gamme et écologiques. Livraison gratuite à partir de 50 €. Expédition en 24h.`
        )
        
        // for debug
        // console.log({
          // 'original_title': ORIGINAL_TITLE,
          // 'original_h1': ORIGINAL_H1
        //   'title': `${ORIGINAL_H1} ${strGamme} ${strSupport} | Guard Industrie`,
        //   'meta': `Découvrez ${ORIGINAL_H1.toLowerCase()} ${strGamme}${strSupport} hauts de gamme et écologiques. Livraison gratuite à partir de 50 €. Expédition en 24h.`,
        //   'h1': `${ORIGINAL_H1} ${strGamme} ${strSupport}`
        // })
        
        document.querySelector('.inner').innerHTML = 
          `<h2>Découvrez ${ORIGINAL_H1.toLowerCase()} ${strGamme}${strSupport} hauts de gamme et écologiques.</h2>
          <p>Bénéficiez de conseil sur l\'utilisation de nos produits${strSupport}.</p>`
      }
    })
  }

});
