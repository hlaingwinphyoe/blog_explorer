require('./bootstrap');

import ScrollReveal from 'scrollreveal'

ScrollReveal().reveal('.post',{
    distance: '10px',
    duration: 300,
    origin: 'top',
    interval: 800,
    delay: 400
})

new VenoBox({
    selector: '.venobox'
});
