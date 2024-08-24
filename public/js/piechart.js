document.addEventListener("DOMContentLoaded", function() {
    const data = [
        { name: 'Requests', value: 50, color: 'gray' },
        { name: 'Proposal', value: 50, color: 'darkgray' },
    ];

    function updatePieChart(data) {
        const total = data.reduce((sum, item) => sum + item.value, 0);
        let currentAngle = 0;
        const gradientParts = data.map(item => {
            const angle = (item.value / total) * 360;
            const startAngle = currentAngle;
            currentAngle += angle;
            return `${item.color} ${startAngle}deg ${currentAngle}deg`;
        }).join(', ');

        const pieChart = document.getElementById('piechart');
        pieChart.style.backgroundImage = `conic-gradient(${gradientParts})`;

        // console.log(`conic-gradient(${gradientParts})`);
    }

    // Initial update
    updatePieChart(data);
});

