document.addEventListener('DOMContentLoaded', function() {
    const tagInput = document.getElementById('postTags');
    const tagsContainer = document.getElementById('tagsContainer');
    const tagsArrayInput = document.getElementById('tagsArray');
    const maxTags = parseInt(tagInput.dataset.maxTags) || 5;
    let tags = [];

    // Add tag function
    function addTag(text) {
        if (tags.length >= maxTags) return;
        const trimmedText = text.trim();
        if (!trimmedText) return;
        if (tags.includes(trimmedText)) return;

        tags.push(trimmedText);
        renderTags();
        tagInput.value = '';
        updateHiddenInput();
    }


    function removeTag(index) {
        tags.splice(index, 1);
        renderTags();
        updateHiddenInput();
    }

    // Render tags to DOM
    function renderTags() {
        tagsContainer.innerHTML = '';
        tags.forEach((tag, index) => {
            const tagElement = document.createElement('div');
            tagElement.className = 'tag';

            const tagText = document.createElement('span');
            tagText.textContent = tag;

            const removeBtn = document.createElement('span');
            removeBtn.className = 'tag-remove';
            removeBtn.innerHTML = '&times;';
            removeBtn.addEventListener('click', () => removeTag(index));

            tagElement.appendChild(tagText);
            tagElement.appendChild(removeBtn);
            tagsContainer.appendChild(tagElement);
        });

        if (tags.length >= maxTags) {
            tagInput.classList.add('tag-input-disabled');
            tagInput.placeholder = 'Maximum tags reached';
        } else {
            tagInput.classList.remove('tag-input-disabled');
            tagInput.placeholder = 'e.g. html css javascript';
        }
    }

    function updateHiddenInput() {
        tagsArrayInput.value = JSON.stringify(tags);
    }

    tagInput.addEventListener('keydown', function(e) {
        if (['Enter', 'Comma', ' '].includes(e.key)) {
            e.preventDefault();
            addTag(this.value);
        }
    });


    if (tagsArrayInput.value) {
        try {
            tags = JSON.parse(tagsArrayInput.value);
            renderTags();
        } catch (e) {
            console.error('Error parsing tags:', e);
        }
    }
});