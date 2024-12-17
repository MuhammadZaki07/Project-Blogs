<script>
    function fetchImage(category, elementId) {
        fetch(`https://api.unsplash.com/search/photos?query=${category}&client_id=lN2xq3PnCze1bdnyNHZQ3fOS5U5rcSq7GKeFRgKvx84`)
            .then(response => response.json())
            .then(data => {
                const imgElement = document.getElementById(elementId);
                imgElement.src = data.results[0].urls.full;
            })
            .catch(error => console.error('Error fetching images:', error));
    }

    function searchCategory() {
        const category = document.getElementById('search-input').value;
        if (category) {
            fetchImage(category, 'food-bg');
            fetchImage(category, 'tech-bg');
            fetchImage(category, 'sport-bg');
        } else {
            console.error('Please enter a category.');
        }
    }

    fetchImage('foods', 'food-bg');
    fetchImage('technology', 'tech-bg');
    fetchImage('sports', 'sport-bg');
</script>
