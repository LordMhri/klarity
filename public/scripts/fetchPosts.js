function fetchPosts(){
    fetch('../../handlers/fetch_posts.php')
        .then(response => {
            if (!response.ok) {
                throw new Error(response.statusText);
            }

            return response.json();
        } ).then(data => {
            if (data && data.length > 0) {
                data.forEach(postData => {

                })
            }
    })
}