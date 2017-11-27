var getHeight = function(el) {
        var el_style      = window.getComputedStyle(el),
            el_display    = el_style.display,
            el_position   = el_style.position,
            el_visibility = el_style.visibility,
            el_max_height = el_style.maxHeight.replace('px', '').replace('%', ''),

            wanted_height = 0;


        // si no está oculto, solo devolvemos la altura normal
        if(el_display !== 'none' && el_max_height !== '0') {
            return el.offsetHeight;
        }

        // el elemento está oculto así que:
        // haciendo el bloque para que podamos medir su altura pero estar oculto
        el.style.position   = 'absolute';
        el.style.visibility = 'hidden';
        el.style.display    = 'block';

        wanted_height     = el.offsetHeight;

        // reverting to the original values
        el.style.display    = el_display;
        el.style.position   = el_position;
        el.style.visibility = el_visibility;

        return wanted_height;
    },

    toggleSlide = function(el) {
        var el_max_height = 0;

        if(el.getAttribute('data-max-height')) {
            // we've already used this before, so everything is setup
            if(el.style.maxHeight.replace('px', '').replace('%', '') === '0') {
                el.style.maxHeight = el.getAttribute('data-max-height');
            } else {
                el.style.maxHeight = '0';
            }
        } else {
            el_max_height                  = getHeight(el) + 'px';
            el.style['transition']         = 'max-height 1.0s ease-in-out';
            el.style.overflowY             = 'hidden';
            el.style.maxHeight             = '0';
            el.setAttribute('data-max-height', el_max_height);
            el.style.display               = 'block';

            // we use setTimeout to modify maxHeight later than display (to we have the transition effect)
            setTimeout(function() {
                el.style.maxHeight = el_max_height;
            }, 300);
        }
    };
var body = document.getElementsByTagName("body")[0];
var pos = 0;
var respuestas = document.getElementsByClassName("respuestas");
    body.addEventListener("load", function (e) {
        while(pos<respuestas.length){
            toggleSlide(respuestas[pos]);
            pos++;
        };
    }, true);
