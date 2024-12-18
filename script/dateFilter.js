document.getElementById('filterButton').addEventListener('click', function() {
            const startDate = new Date(document.getElementById('startDate').value);
            const endDate = new Date(document.getElementById('endDate').value);
            const resultsList = document.getElementById('resultsList');
            const items = resultsList.querySelectorAll('li');

            items.forEach(function(item) {
                const itemDate = new Date(item.textContent.split('- ')[1]);
                if (itemDate >= startDate && itemDate <= endDate) {
                    item.style.display = '';
                } else {
                    item.style.display = 'none';
                }
            });
        });
