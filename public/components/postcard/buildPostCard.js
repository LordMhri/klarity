export class PostCard {
    static render(post) {
        const card = document.createElement('div');
        card.className = 'post-card';
        card.innerHTML = `
            <h3>${post.title}</h3>
            <p>${post.content}</p>
            <div class="post-meta">
                <span>By ${post.author}</span>
                <span>${post.date}</span>
            </div>
        `;
        return card;
    }
}