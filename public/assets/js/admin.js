document.addEventListener('DOMContentLoaded', function() {
    console.log("DOM loaded");
    
    // Initialize sidebar toggle functionality
    initializeSidebar();
    
    // Initialize dropdown functionality
    initializeDropdown();
    
    // Initialize and render chart if chart container exists
    initializeChart();
});

// Sidebar functionality
function initializeSidebar() {
    const sidebarToggle = document.getElementById("admin-sidebar-toggle");
    const sidebar = document.getElementById("admin-sidebar");
    const content = document.querySelector(".admin-content");
    const header = document.querySelector(".admin-header");
  
    // Define width values for expanded and collapsed states
    const expandedWidth = "250px";
    const collapsedWidth = "60px";
  
    // Function to apply the sidebar and header state
    function applySidebarState() {
        const isCollapsed = localStorage.getItem("sidebarCollapsed") === "true";
  
        sidebar.classList.toggle("collapsed", isCollapsed);
        content.style.marginLeft = isCollapsed ? collapsedWidth : expandedWidth;
        header.style.left = isCollapsed ? collapsedWidth : expandedWidth;
        header.style.width = isCollapsed ? `calc(100% - ${collapsedWidth})` : `calc(100% - ${expandedWidth})`;
    }
  
    // Load the state on page load
    if (sidebar && content && header) {
        applySidebarState();
      
        // Toggle sidebar on button click
        if (sidebarToggle) {
            sidebarToggle.addEventListener("click", function () {
                const isCollapsed = sidebar.classList.toggle("collapsed");
          
                // Adjust content margin and header position based on sidebar state
                content.style.marginLeft = isCollapsed ? collapsedWidth : expandedWidth;
                header.style.left = isCollapsed ? collapsedWidth : expandedWidth;
                header.style.width = isCollapsed ? `calc(100% - ${collapsedWidth})` : `calc(100% - ${expandedWidth})`;
          
                // Store the new state in localStorage
                localStorage.setItem("sidebarCollapsed", isCollapsed);
                
                // Resize chart if it exists
                if (window.adminChart) {
                    setTimeout(() => {
                        window.adminChart.updateOptions({
                            chart: { width: '100%' }
                        });
                    }, 300);
                }
            });
        }
    }
}

// Dropdown functionality
function initializeDropdown() {
    document.addEventListener("click", function (event) {
        const dropdownToggle = document.getElementById("admin-dropdown-toggle");
        const userMenu = document.querySelector(".admin-user-menu");
      
        if (dropdownToggle && userMenu && !userMenu.contains(event.target)) {
            dropdownToggle.checked = false; // Close the dropdown
        }
    });
}

// Color Scheme Definitions
const colorSchemes = {
    default: {
        primary: '#021526',
        secondary: '#6EACDA',
        accent: '#4A90E2',
        text: '#2C3E50'
    },
    oceanInspired: {
        primary: '#003566', // Deep Navy
        secondary: '#00A8E8', // Vivid Sky Blue
        accent: '#FFB703', // Sunglow
        text: '#14213D', // Space Cadet
    },
    modernCorporate: {
        primary: '#006D77', // Peacock Blue
        secondary: '#6EACDA',
        accent: '#2C3E50',
        text: '#E29578', // Light Coral
    },
    subtleProfessional: {
        primary: '#284B63', // Midnight Blue
        secondary: '#43AA8B', // Mint Green
        accent: '#90BE6D', // Pistachio
        text: '#F94144', // Red Orange
    },
    deepOcean: {
        primary: '#001524', // Dark Sapphire
        secondary: '#15616D', // Dark Cyan
        accent: '#FFE156', // Golden Poppy
        text: '#FF7D00', // Bright Orange
    },    
};

// Counter Animation Function
function animateValue(obj, start, end, duration) {
    let startTimestamp = null;
    const step = (timestamp) => {
        if (!startTimestamp) startTimestamp = timestamp;
        const progress = Math.min((timestamp - startTimestamp) / duration, 1);
        obj.innerHTML = Math.floor(progress * (end - start) + start);
        if (progress < 1) {
            window.requestAnimationFrame(step);
        }
    };
    window.requestAnimationFrame(step);
}

// Function to update chart colors
function updateChartColors(chart, scheme) {
    const colors = [
        scheme.secondary,
        scheme.primary,
        scheme.accent,
        scheme.text
    ];
    
    chart.updateOptions({
        colors: colors,
        grid: {
            borderColor: getComputedStyle(document.documentElement)
                .getPropertyValue('--background-color-dark') || '#f1f1f1'
        }
    });
}

// Initialize and render chart
function initializeChart() {
    try {
        // Check if chart container exists
        const chartContainer = document.getElementById('admin-jobChart');
        if (!chartContainer) {
            console.log("Chart container not found, skipping chart initialization");
            return;
        }
        
        console.log("Chart container found");
        
        // Initialize counters if they exist
        const counterElements = {
            totalJobs: document.getElementById('totalJobs'),
            activeUsers: document.getElementById('activeUsers'),
            employers: document.getElementById('employers'),
            applications: document.getElementById('applications')
        };
        
        // Animate counters if they exist
        Object.entries(counterElements).forEach(([id, element]) => {
            if (element) {
                const value = parseInt(element.dataset.value || 0);
                console.log(`Animating counter: ${id} with value: ${value}`);
                animateValue(element, 0, value, 2000);
            }
        });
        
        // Get chart data from data attributes
        let months, jobs, applications, users, companies;
        
        try {
            months = JSON.parse(chartContainer.dataset.months || '[]');
            jobs = JSON.parse(chartContainer.dataset.jobs || '[]');
            applications = JSON.parse(chartContainer.dataset.applications || '[]');
            users = JSON.parse(chartContainer.dataset.users || '[]');
            companies = JSON.parse(chartContainer.dataset.companies || '[]');
            
            console.log("Chart data parsed:", {months, jobs, applications, users, companies});
            
            // If no data, use fallback
            if (months.length === 0) {
                console.warn("No months data, using fallback");
                months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'];
            }
            
            if (jobs.length === 0) {
                console.warn("No jobs data, using fallback");
                jobs = [31, 40, 28, 51, 42, 109, 100];
            }
            
            if (applications.length === 0) {
                console.warn("No applications data, using fallback");
                applications = [11, 32, 45, 32, 34, 52, 41];
            }
            
            if (users.length === 0) {
                console.warn("No users data, using fallback");
                users = [22, 44, 76, 34, 65, 34, 90];
            }
            
            if (companies.length === 0) {
                console.warn("No companies data, using fallback");
                companies = [11, 33, 76, 89, 90, 52, 41];
            }
        } catch (error) {
            console.error("Error parsing chart data:", error);
            
            // Use fallback data if parsing fails
            months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'];
            jobs = [31, 40, 28, 51, 42, 109, 100];
            applications = [11, 32, 45, 32, 34, 52, 41];
            users = [22, 44, 76, 34, 65, 34, 90];
            companies = [11, 33, 76, 89, 90, 52, 41];
        }
        
        // Check if ApexCharts is loaded
        if (typeof ApexCharts === 'undefined') {
            console.error("ApexCharts library not loaded");
            return;
        }
        
        console.log("Initializing chart");
        
        // Chart Configuration
        const options = {
            series: [{
                name: 'Jobs',
                data: jobs
            },{
                name: 'Applications',
                data: applications
            },{
                name: 'Users',
                data: users
            }, {
                name: 'Companies',
                data: companies
            }],
            chart: {
                height: 350,
                type: 'area',
                fontFamily: 'Segoe UI, Tahoma, Geneva, Verdana, sans-serif',
                toolbar: {
                    show: false
                },
                animations: {
                    enabled: true,
                    easing: 'easeinout',
                    speed: 800,
                    animateGradually: {
                        enabled: true,
                        delay: 150
                    },
                    dynamicAnimation: {
                        enabled: true,
                        speed: 350
                    }
                }
            },
            colors: [
                '#6EACDA', // Secondary
                '#021526', // Primary
                '#4A90E2', // Accent
                '#2C3E50'  // Text
            ],
            fill: {
                type: 'gradient',
                gradient: {
                    shadeIntensity: 1,
                    opacityFrom: 0.7,
                    opacityTo: 0.2,
                    stops: [0, 90, 100]
                }
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                curve: 'smooth',
                width: 2
            },
            grid: {
                borderColor: '#f1f1f1',
                strokeDashArray: 4,
                padding: {
                    top: 0,
                    right: 0,
                    bottom: 0,
                    left: 0
                }
            },
            xaxis: {
                categories: months,
                labels: {
                    style: {
                        fontFamily: 'Segoe UI, Tahoma, Geneva, Verdana, sans-serif',
                    }
                }
            },
            yaxis: {
                labels: {
                    formatter: function(value) {
                        return value.toFixed(0);
                    }
                }
            },
            legend: {
                position: 'top',
                horizontalAlign: 'right',
                fontFamily: 'Segoe UI, Tahoma, Geneva, Verdana, sans-serif',
            },
            tooltip: {
                enabled: true,
                shared: true,
                intersect: false,
                y: {
                    formatter: function(value) {
                        return value.toFixed(0);
                    }
                }
            },
            responsive: [{
                breakpoint: 768,
                options: {
                    chart: {
                        height: 300
                    },
                    legend: {
                        position: 'bottom',
                        horizontalAlign: 'center'
                    }
                }
            }]
        };
        
        // Initialize Chart
        const chart = new ApexCharts(chartContainer, options);
        chart.render();
        
        // Store chart in window for global access
        window.adminChart = chart;
        console.log("Chart rendered");
        
        // Add color scheme switcher functionality
        addColorSchemeSwitcher(chart);
        
        // Handle Window Resize
        window.addEventListener('resize', () => {
            if (window.adminChart) {
                window.adminChart.updateOptions({
                    chart: {
                        width: '100%'
                    }
                });
            }
        });
        
    } catch (error) {
        console.error("Error initializing chart:", error);
    }
}

// Function to add color scheme switcher
function addColorSchemeSwitcher(chart) {
    const chartContainer = document.getElementById('admin-jobChart');
    if (!chartContainer) return;
    
    // Check if switcher already exists
    if (document.getElementById('color-scheme-switcher')) return;
    
    const schemeSwitcherContainer = document.createElement('div');
    schemeSwitcherContainer.className = 'color-scheme-container';
    schemeSwitcherContainer.style.marginBottom = '15px';
    
    const schemeSwitcherLabel = document.createElement('label');
    schemeSwitcherLabel.textContent = 'Color Scheme: ';
    schemeSwitcherLabel.htmlFor = 'color-scheme-switcher';
    schemeSwitcherLabel.style.marginRight = '10px';
    schemeSwitcherLabel.style.fontWeight = 'bold';
    
    const schemeSwitcher = document.createElement('select');
    schemeSwitcher.id = 'color-scheme-switcher';
    schemeSwitcher.className = 'color-scheme-select';
    schemeSwitcher.style.padding = '5px';
    schemeSwitcher.style.borderRadius = '4px';
    
    Object.keys(colorSchemes).forEach(schemeName => {
        const option = document.createElement('option');
        option.value = schemeName;
        option.textContent = schemeName.charAt(0).toUpperCase() + schemeName.slice(1).replace(/([A-Z])/g, ' $1');
        schemeSwitcher.appendChild(option);
    });
    
    schemeSwitcherContainer.appendChild(schemeSwitcherLabel);
    schemeSwitcherContainer.appendChild(schemeSwitcher);
    
    // Insert the scheme switcher before the chart
    chartContainer.parentNode.insertBefore(
        schemeSwitcherContainer,
        chartContainer
    );
    
    // Handle color scheme changes
    schemeSwitcher.addEventListener('change', (e) => {
        const selectedScheme = colorSchemes[e.target.value];
        updateChartColors(chart, selectedScheme);
        
        // Save to localStorage
        localStorage.setItem('adminChartColorScheme', e.target.value);
    });
    
    // Apply saved scheme if exists
    const savedScheme = localStorage.getItem('adminChartColorScheme');
    if (savedScheme && colorSchemes[savedScheme]) {
        schemeSwitcher.value = savedScheme;
        updateChartColors(chart, colorSchemes[savedScheme]);
    }
}