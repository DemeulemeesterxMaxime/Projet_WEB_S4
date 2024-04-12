    // //on va poster le formulaire de la note

    // let form = document.getElementById('form');

    // form.addEventListener('change', function (e) {
    //     form.submit();
    //     console.log('form submited');

    // });

    // Fonction pour détecter les changements d'options
    document.getElementById('matiere').addEventListener('change', function() {
        // Actualiser le formulaire sans rechargement de page
        localStorage.setItem("mat", this.value);
        document.getElementById('form').submit();        
    });

    document.getElementById('date').addEventListener('change', function() {
        // Actualiser le formulaire sans rechargement de page
        localStorage.setItem("dat", this.value);
        document.getElementById('form').submit();
    });

    window.onload = function () {
      var matiereSelect = localStorage.getItem("mat");
      if (matiereSelect) {
        document.getElementById("matiere").value = matiereSelect;
      }

      var dateSelect = localStorage.getItem("dat");
      if (dateSelect) {
        document.getElementById("date").value = dateSelect;
      }
    };