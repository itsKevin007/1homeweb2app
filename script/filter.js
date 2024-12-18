const categoryFilterList = document.querySelector(".category-filters");
const categoryFilters = categoryFilterList.querySelectorAll("[data-filter]");
const categoryItemsList = document.querySelector(".category-items");
const categoryItems = categoryItemsList.querySelectorAll("[data-category]");


  [...categoryItems].map((item, i) => {
    item.style.viewTransitionName = `item-${++i}`;
  });
categoryFilters.forEach((filter) => {
  filter.addEventListener("click", (e) => {
    const currentFilter = e.currentTarget;
    const currentCategory = e.currentTarget.getAttribute("data-filter");
    if (document.startViewTransition) {
      document.startViewTransition(() => {
        updateSelectedFilter(currentFilter);
        filterCategory(currentCategory);
      });
    } else {
      updateSelectedFilter(currentFilter);
      filterCategory(currentCategory);
    }
  });
});


  function updateSelectedFilter(filterSelector) {
    const selected = document.querySelector('.category-filters .selected');
    if (selected) selected.classList.remove('selected');
    filterSelector.classList.add('selected');
  }
function filterCategory(filter) {
  [...categoryItems].map((item, i) => {
    item.setAttribute("hidden", "")
  });
  const filteredCategory = [...categoryItems].filter(  (cat) => cat.getAttribute("data-category") === filter || filter === "all" );
  filteredCategory.map((cat) => cat.removeAttribute("hidden"));
}
