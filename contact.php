<?php
include "header.php";
?>
<style>
  .card {
    border-radius: 0.125rem;
    background: rgba(247, 248, 250, 0.65);
    backdrop-filter: blur(3.5px);
  }

  .hidden {
    opacity: 0;
    transform: translateX(50px);
    filter: blur(5px);
    transition: opacity 1s ease 0.2s, transform 1s ease 0.2s, filter 1s ease 0.2s;
  }

  .show {
    opacity: 1;
    transform: translateY(0);
    filter: blur(0);
  }

  .card-delay-200 {
    transition-delay: 200ms;
  }

  .card-delay-400 {
    transition-delay: 400ms;
  }

  .card-delay-600 {
    transition-delay: 600ms;
  }
</style>
<section class="vh-100 pt-5 hidden-section">
  <div class="container text-center mt-5">
    <div class="row pt-4">
      <div class="col-4 me-5" style="padding-top:35vh;">
        <p class="display-1 hidden card-delay-200">OUR TEAM</p>
      </div>
      <div class="col ms-5">
        <div class="row">
          <div class="col">
            <div class="card rounded hidden card-delay-400" style="width: 18rem;">
              <img src="components/fadhil.png" class="card-img-top img-fluid" alt="...">
              <div class="card-body">
                <p class="text-start card-text h6 hidden card-delay-200">Hudan</p>
                <h1 class="text-start card-text hidden card-delay-400">As</h1>
                <p class="text-start card-text display-6 hidden card-delay-600">Designer</p>
              </div>
            </div>
          </div>
          <div class="col" style="padding-top:30vh;">
            <div class="card rounded hidden card-delay-600" style="width: 18rem;">
              <img src="components/fadhil.png" class="card-img-top img-fluid" alt="...">
              <div class="card-body">
                <p class="text-start card-text h6 hidden card-delay-200">Fadhil</p>
                <h1 class="text-start card-text hidden card-delay-400">As</h1>
                <p class="text-start card-text display-6 hidden card-delay-600">Developer</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
<script>
  const observer = new IntersectionObserver((entries) => {
    entries.forEach((entry) => {
      console.log(entry)
      if (entry.isIntersecting) {
        entry.target.classList.add('show');
      } else {
        entry.target.classList.remove('show');
      }
    });
  });
  const animate = document.querySelectorAll('.hidden');
  animate.forEach((el) => observer.observe(el));
</script>
</body>

</html>