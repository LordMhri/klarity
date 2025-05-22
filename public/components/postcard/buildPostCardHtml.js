// This function takes a single post data object (like the JSON you showed)
// and returns the HTML string for a single post card.
function buildPostCardHtml(postData) {
    // Use template literals (backticks ``) for easier HTML string creation

    // You provided this base structure:
    /*
    <div class="post-container">
       <div class="content"> // <-- Note: User's template used 'content', but previous discussion used 'content-container'
           <h3 class="post-title"></h3>
           <p class="post-content"></p> // <-- Note: User's template used 'post-content', but previous discussion used 'post-snippet'
           <div class="tags"></div>
           <p class="datetime"></p>
       </div>
        <div class="attribute"> // <-- Note: User's template used 'attribute', but previous discussion used 'attribute-container'
            <h5 class="votes"></h5> // <-- User's template used h5
            <h5 class="replies"></h5> // <-- User's template used h5
            <h5 class="views"></h5> // <-- User's template used h5
        </div>
    </div>
    */

    // Let's use the class names from your latest template (.content, .attribute, .post-title, .post-content, etc.)
    // and populate them with data from the postData object.

    // --- Prepare Data ---
    // For the link, use the post ID
    const postUrl = `/post/${postData.id}`; // Example URL structure, adjust as needed

    // Format date/time (basic example, you might use a library for better formatting)
    const postDate = new Date(postData.created_at).toLocaleDateString();
    // You might also want to show updated_at if it's different from created_at

    // Handle the content snippet (take first N characters)
    const snippetLength = 200; // Or whatever length you prefer
    const postSnippet = postData.content.length > snippetLength
        ? postData.content.substring(0, snippetLength) + '...'
        : postData.content;

    // --- Build HTML String ---
    const postHtml = `
        <div class="post-container" data-post-id="${postData.id}" data-post-type="${postData.type}">
            <div class="attribute"> {/* This container will hold stats */}
                <div class="post-votes"> {/* Wrap stats to style number and label */}
                    <div class="vote-count">${postData.vote_count}</div>
                    <div class="vote-label">votes</div>
                </div>
                <div class="post-replies"> {/* Wrap responses/replies stat */}
                    <div class="reply-count">${postData.response_count}</div>
                    <div class="reply-label">${postData.type === 'question' ? 'answers' : 'replies'}</div> {/* Label changes based on type */}
                </div>
                 <div class="post-views"> {/* Wrap views stat */}
                    <div class="view-count">${postData.view_count}</div>
                    <div class="view-label">views</div>
                </div>
                {/* Add elements here for is_closed if you want a visual indicator */}
                ${postData.is_closed ? '<div class="post-closed-indicator">Closed</div>' : ''}
            </div>
            <div class="content"> {/* This container holds main text content */}
                <h3 class="post-title">
                    <a href="${postUrl}">${postData.title}</a> {/* Title linked to the post */}
                </h3>
                <p class="post-content">${postSnippet}</p> {/* Content snippet */}

                <div class="tags">
                    {/* Tags will be inserted here when you fetch them */}
                    </div>

                <div class="post-meta"> {/* Container for author and date/time */}
                    <span class="post-author">By ${postData.author_id}</span> {/* You'll need logic to get author name from author_id */}
                    on <span class="post-datetime">${postDate}</span> {/* Use formatted date */}
                    ${postData.created_at !== postData.updated_at ? '(edited)' : ''} {/* Indicate if edited */}
                </div>
            </div>
        </div>
    `; // End of template literal

    // --- Return the HTML string ---
    return postHtml;
}

// --- Reminder: How to use this function in your fetch success callback ---
/*
// Inside your fetch .then(data => { ... }) block, within the loop:
data.forEach(postData => {
    const postHtmlString = buildPostCardHtml(postData);
    // Append the string to your container:
    document.getElementById('post-list-container').innerHTML += postHtmlString;
    // Or with jQuery: $('#post-list-container').append(postHtmlString);
});
*/