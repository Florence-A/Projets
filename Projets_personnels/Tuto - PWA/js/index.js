const form = document.getElementById('searchForm')
const searchInput = document.getElementById('searchInput')
const result = document.getElementById('result')

let search = ""
let movie = []

const fetchMovies = async ()=>{
    movies = await fetch(`https://api.themoviedb.org/3/search/movie?api_key=810771b584078c5c9db8653ed56a05a8&query=${search}`
    ).then((res) => res.json())
    console.log(movies)
}

form.addEventListener('submit',(e)=>{
    e.preventDefault()
    search = searchInput.value
    fetchMovies()
})

