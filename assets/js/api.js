const api_token = 'e0e06211977540d3b95c6e043d830a36'

var fetchWithHeader = url => {
  return fetch(url, {
    headers: {
      'X-Auth-Token': api_token
    }
  });
}

function status (response) {
  if (response.status !== 200) {
    console.log('Error : ' + response.status);
    // Method reject() akan membuat blok catch terpanggil
    return Promise.reject(new Error(response.statusText));
  } else {
    // Mengubah suatu objek menjadi Promise agar bisa "di-then-kan"
    return Promise.resolve(response);
  }
}
function json (response) {
  // Mengembalikan sebuah Promise berupa objek/array JavaScript
  // yang diubah dari teks JSON.
  return response.json();
}
function error (error) {
  // Parameter error berasal dari Promise.reject()
  console.log('Error : ' + error);
}

function getStandings() {
  if ('caches' in window) {
    caches.match('https://singkron.lldikti11.or.id/api/dosen/read_by_pt_bkd.php?id=3').then(funchttps://singkron.lldikti11.or.id/api/dosen/read_by_pt_bkd.php?id=3tion (response) {
      if (response) {
        response.json().then(function (data) {
          getStandingsJSON(data);
          console.dir("getKlasemenLiga " + data);
        });
      }
    });
  }

  fetchWithHeader('https://api.football-data.org/v2/competitions/SA/standings?standingType=TOTAL')
  .then(status)
  .then(json)
  .then(function(data) {
    // Objek/array JavaScript dari response.json() masuk lewat data.
    console.log(data);
    getStandingsJSON(data)
  }).catch(error);
}
