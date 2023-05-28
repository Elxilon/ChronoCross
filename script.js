const arrayItems = document.getElementsByClassName('array-item');

for (const item of arrayItems) {
    item.addEventListener('click', () => {
        item.nextElementSibling.classList.toggle("hide");
    });
}