import {PostCard} from '../../components/postcard/buildPostCard.js';

const mockPosts = [
    {
        id: 1,
        title: "React Fragment Error after upgrading to Nextjs 15",
        excerpt: "After upgrading project to NextJS 15 I keep getting this error...",
        author: "saleebdebnah1435",
        date: "03/01/2025, 10:13:43 PM",
        tags: ["nextjs", "reactjs"]
    },
    {
        id: 1,
        title: "React Fragment Error after upgrading to Nextjs 15",
        excerpt: "After upgrading project to NextJS 15 I keep getting this error...",
        author: "saleebdebnah1435",
        date: "03/01/2025, 10:13:43 PM",
        tags: ["nextjs", "reactjs"]
    },
    {
        id: 1,
        title: "React Fragment Error after upgrading to Nextjs 15",
        excerpt: "After upgrading project to NextJS 15 I keep getting this error...",
        author: "saleebdebnah1435",
        date: "03/01/2025, 10:13:43 PM",
        tags: ["nextjs", "reactjs"]
    },
    {
        id: 1,
        title: "React Fragment Error after upgrading to Nextjs 15",
        excerpt: "After upgrading project to NextJS 15 I keep getting this error...",
        author: "saleebdebnah1435",
        date: "03/01/2025, 10:13:43 PM",
        tags: ["nextjs", "reactjs"]
    },
    {
        id: 1,
        title: "React Fragment Error after upgrading to Nextjs 15",
        excerpt: "After upgrading project to NextJS 15 I keep getting this error...",
        author: "saleebdebnah1435",
        date: "03/01/2025, 10:13:43 PM",
        tags: ["nextjs", "reactjs"]
    },
    {
        id: 1,
        title: "React Fragment Error after upgrading to Nextjs 15",
        excerpt: "After upgrading project to NextJS 15 I keep getting this error...",
        author: "saleebdebnah1435",
        date: "03/01/2025, 10:13:43 PM",
        tags: ["nextjs", "reactjs"]
    }
];



const postsContainer = document.getElementById('posts-container');
mockPosts.forEach(post => {
    postsContainer.appendChild(PostCard.render(post));
});