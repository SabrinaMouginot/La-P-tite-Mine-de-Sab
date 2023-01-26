{/* <script> */}
        let slideIndex = 1;
        showSlides(slideIndex);

        // Controle "précédent"/"suivant"
        function plusSlides(n) {
          showSlides((slideIndex += n));
        }

        function showSlides(n) {
          let i;
          let slides = document.getElementsByClassName("mySlides");
          let dots = document.getElementsByClassName("demo");
          let captionText = document.getElementById("caption");
          if (n > slides.length) {
            slideIndex = 1;
          }
          if (n < 1) {
            slideIndex = slides.length;
          }
          for (i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";
          }
          for (i = 0; i < dots.length; i++) {
            dots[i].className = dots[i].className.replace(" active", "");
          }
          slides[slideIndex - 1].style.display = "block";
          dots[slideIndex - 1].className += "active";
          captionText.innerHTML = dots[slideIndex - 1].alt;
}
        

// class imgSlider{
//   /** la class va nous permettre de mettre en place tous nos éléments */
//   constructor(img) {

//     this.imgs = imgs; /**stocker toutes les images */
//     this.currentimgIndex = 0; /**index de l'image actuel. L'index 0 pour l'image' 1. */
//   }
//   getCurrentimg() {
//     /**pour obtenir l'image actuelle */
//     return this.imgs[this.currentimgIndex];
//   } /**au début, l'index est à 0 mais au fur et à mesure qu'on avance dans le carrousel, on fait +1 */


//   guess(answer) {
//     /**vérifie la réponse de l'utilisateur si c'est true */
//     if (this.getCurrentimg().isCorrectAnswer(answer)) {
//       this.score++;
//     } /**si la réponse est true, on la comptabilise dans le score et on passe à l'image suivante */
//     this.currentimgIndex++;
//   } /**L'index passera à l'image suivante. */


//   hasEnded() {
//     /**Pour quand c'est fini. */
//     return this.currentimgIndex >= this.imgs.length;
//     //length permet de connaitre le nombre d'entrée dans un tableau par ex.
//   } //si on arrive à l'index de la dernière alors hasEnded(c'est terminé)
// }

    //   </script>