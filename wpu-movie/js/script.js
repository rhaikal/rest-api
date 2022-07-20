function searchMovie() {
  $('#movie-list').html('');
  $.ajax({
    type: 'get',
    url: 'http://www.omdbapi.com/',
    data: {
      apikey: '163ce74b',
      s: $('#search-input').val(),
    },
    dataType: 'json',
    success: function (response) {
      if (response.Response === 'True') {
        let movies = response.Search;
        $.each(movies, function (i, data) {
          $('#movie-list').append(
            `
            <div class="col-md-4">
             <div class="card mb-3 mx-auto" style="width: 18rem;">
              <img src="` +
              data.Poster +
              `" class="card-img-top" alt="...">
              <div class="card-body">
              <h5 class="card-title">` +
              data.Title +
              `</h5>
              <h6 class="card-subtitle mb-2 text-muted">` +
              data.Year +
              `</h6>
              <a href="#" class="card-link see-detail" data-bs-toggle="modal" data-bs-target="#exampleModal" data-id="` +
              data.imdbID +
              `">See Detail</a>
              </div>
             </div>
            </div>
           `
          );
        });

        $('#search-input').val('');
      } else {
        $('#movie-list').html(
          `<div class="col">
            <h1 class="text-center">` +
            response.Error +
            `</h1>
           </div>`
        );
      }
    },
  });
}

$('#search-button').on('click', function () {
  searchMovie();
});

$('#search-input').on('keyup', function (e) {
  if (e.which === 13) {
    searchMovie();
  }
});

$('#movie-list').on('click', '.see-detail', function () {
  $.ajax({
    type: 'get',
    url: 'http://omdbapi.com',
    data: {
      apikey: '163ce74b',
      i: $(this).data('id'),
    },
    dataType: 'json',
    success: function (movie) {
      if (movie.Response === 'True') {
        $('.modal-body').html(
          `
         <div class="container-fluid">
          <div class="row">
           <div class="col-md-4">
            <img src="` +
            movie.Poster +
            `" class="mx-auto img-fluid">
           </div>
           <div class="col-md-8">
            <ul class="list-group">
            <li class="list-group-item"><h3>` +
            movie.Title +
            `</h3></li>
            <li class="list-group-item">Released : ` +
            movie.Released +
            `</li>
            <li class="list-group-item">Genre : ` +
            movie.Genre +
            `</li>
            <li class="list-group-item">Director : ` +
            movie.Director +
            `</li>
            <li class="list-group-item">Actors : ` +
            movie.Actors +
            `</li>
            </ul>
           </div>
          </div>
         </div>
        `
        );
      }
    },
  });
});
