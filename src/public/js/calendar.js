const $document = document;
const $title = $document.querySelector('.schedule-title');
const titleContent = $title.textContent;

if (titleContent.length > 7) {
    $title.textContent = titleContent.substring(0, 7) + '...';
}
