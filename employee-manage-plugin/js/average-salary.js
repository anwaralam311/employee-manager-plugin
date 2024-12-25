document.addEventListener("DOMContentLoaded", function () {
    const calculateButton = document.getElementById("calculate_avg_salary");
    const salaryDisplay = document.getElementById("average_salary_display");

    if (calculateButton && salaryDisplay) {
        calculateButton.addEventListener("click", function () {
            jQuery.ajax({
                url: emp_ajax.ajax_url, 
                method: "POST",
                data: {
                    action: "emp_average_salary", 
                },
                success: function (response) {
                    try {
                  
                        const data = JSON.parse(response);
                        salaryDisplay.textContent = `Average Salary: $${data.average_salary}`;
                    } catch (error) {
                        console.error("Error parsing JSON:", error);
                    }
                },
                error: function (xhr, status, error) {
                    console.error("AJAX request failed:", error);
                }
            });
        });
    }
});
