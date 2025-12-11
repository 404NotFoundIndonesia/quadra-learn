/**
 * Quadratic Graph Renderer
 * Renders quadratic function graphs from HTML data attributes
 */

function renderQuadraticGraphs() {
    document.querySelectorAll('.quadratic-graph').forEach(function(element) {
        const canvas = element.querySelector('.quadratic-canvas');
        if (!canvas) return;
        
        const ctx = canvas.getContext('2d');
        
        // Get parameters from data attributes
        const a = parseFloat(element.dataset.a) || 1;
        const b = parseFloat(element.dataset.b) || 0;
        const c = parseFloat(element.dataset.c) || 0;
        const xMin = parseFloat(element.dataset.xMin) || -5;
        const xMax = parseFloat(element.dataset.xMax) || 5;
        const yMin = parseFloat(element.dataset.yMin) || -5;
        const yMax = parseFloat(element.dataset.yMax) || 5;
        
        // Clear canvas
        ctx.clearRect(0, 0, canvas.width, canvas.height);
        
        // Canvas dimensions
        const width = canvas.width;
        const height = canvas.height;
        const padding = 40;
        
        // Calculate scale
        const xScale = (width - 2 * padding) / (xMax - xMin);
        const yScale = (height - 2 * padding) / (yMax - yMin);
        
        // Helper functions
        function xToCanvas(x) {
            return padding + (x - xMin) * xScale;
        }
        
        function yToCanvas(y) {
            return height - padding - (y - yMin) * yScale;
        }
        
        function quadratic(x) {
            return a * x * x + b * x + c;
        }
        
        // Draw grid
        ctx.strokeStyle = '#e0e0e0';
        ctx.lineWidth = 1;
        
        // Vertical grid lines
        for (let x = Math.ceil(xMin); x <= Math.floor(xMax); x++) {
            const canvasX = xToCanvas(x);
            ctx.beginPath();
            ctx.moveTo(canvasX, padding);
            ctx.lineTo(canvasX, height - padding);
            ctx.stroke();
        }
        
        // Horizontal grid lines
        for (let y = Math.ceil(yMin); y <= Math.floor(yMax); y++) {
            const canvasY = yToCanvas(y);
            ctx.beginPath();
            ctx.moveTo(padding, canvasY);
            ctx.lineTo(width - padding, canvasY);
            ctx.stroke();
        }
        
        // Draw axes
        ctx.strokeStyle = '#333';
        ctx.lineWidth = 2;
        
        // X-axis (y = 0)
        if (yMin <= 0 && yMax >= 0) {
            const y0 = yToCanvas(0);
            ctx.beginPath();
            ctx.moveTo(padding, y0);
            ctx.lineTo(width - padding, y0);
            ctx.stroke();
            
            // X-axis labels
            ctx.fillStyle = '#333';
            ctx.font = '12px Arial';
            ctx.textAlign = 'center';
            for (let x = Math.ceil(xMin); x <= Math.floor(xMax); x++) {
                if (x !== 0) {
                    ctx.fillText(x.toString(), xToCanvas(x), y0 + 15);
                }
            }
        }
        
        // Y-axis (x = 0)
        if (xMin <= 0 && xMax >= 0) {
            const x0 = xToCanvas(0);
            ctx.beginPath();
            ctx.moveTo(x0, padding);
            ctx.lineTo(x0, height - padding);
            ctx.stroke();
            
            // Y-axis labels
            ctx.textAlign = 'right';
            for (let y = Math.ceil(yMin); y <= Math.floor(yMax); y++) {
                if (y !== 0) {
                    ctx.fillText(y.toString(), x0 - 5, yToCanvas(y) + 4);
                }
            }
        }
        
        // Draw origin
        if (xMin <= 0 && xMax >= 0 && yMin <= 0 && yMax >= 0) {
            ctx.fillStyle = '#333';
            ctx.textAlign = 'right';
            ctx.fillText('0', xToCanvas(0) - 5, yToCanvas(0) + 15);
        }
        
        // Draw quadratic function
        ctx.strokeStyle = '#007bff';
        ctx.lineWidth = 3;
        ctx.beginPath();
        
        let firstPoint = true;
        const step = (xMax - xMin) / 200; // More points for smoother curve
        
        for (let x = xMin; x <= xMax; x += step) {
            const y = quadratic(x);
            
            // Only draw if y is within bounds
            if (y >= yMin - (yMax - yMin) * 0.1 && y <= yMax + (yMax - yMin) * 0.1) {
                const canvasX = xToCanvas(x);
                const canvasY = yToCanvas(y);
                
                if (firstPoint) {
                    ctx.moveTo(canvasX, canvasY);
                    firstPoint = false;
                } else {
                    ctx.lineTo(canvasX, canvasY);
                }
            } else if (!firstPoint) {
                // Break the line if we go out of bounds
                ctx.stroke();
                ctx.beginPath();
                firstPoint = true;
            }
        }
        
        if (!firstPoint) {
            ctx.stroke();
        }
        
        // Calculate key points
        const vertex_x = -b / (2 * a);
        const vertex_y = quadratic(vertex_x);
        const discriminant = b * b - 4 * a * c;
        
        // Draw vertex
        if (vertex_x >= xMin && vertex_x <= xMax && vertex_y >= yMin && vertex_y <= yMax) {
            ctx.fillStyle = '#dc3545';
            ctx.beginPath();
            ctx.arc(xToCanvas(vertex_x), yToCanvas(vertex_y), 6, 0, 2 * Math.PI);
            ctx.fill();
            
            // Vertex label
            ctx.fillStyle = '#dc3545';
            ctx.font = 'bold 12px Arial';
            ctx.textAlign = 'center';
            ctx.fillText('V', xToCanvas(vertex_x), yToCanvas(vertex_y) - 10);
        }
        
        // Draw y-intercept
        if (c >= yMin && c <= yMax && 0 >= xMin && 0 <= xMax) {
            ctx.fillStyle = '#28a745';
            ctx.beginPath();
            ctx.arc(xToCanvas(0), yToCanvas(c), 5, 0, 2 * Math.PI);
            ctx.fill();
        }
        
        // Draw x-intercepts (roots) if they exist
        if (discriminant >= 0) {
            const sqrt_discriminant = Math.sqrt(discriminant);
            const x1 = (-b + sqrt_discriminant) / (2 * a);
            const x2 = (-b - sqrt_discriminant) / (2 * a);
            
            if (x1 >= xMin && x1 <= xMax && Math.abs(quadratic(x1)) < 0.1) {
                ctx.fillStyle = '#ffc107';
                ctx.beginPath();
                ctx.arc(xToCanvas(x1), yToCanvas(0), 4, 0, 2 * Math.PI);
                ctx.fill();
            }
            
            if (discriminant > 0 && x2 >= xMin && x2 <= xMax && Math.abs(quadratic(x2)) < 0.1) {
                ctx.fillStyle = '#ffc107';
                ctx.beginPath();
                ctx.arc(xToCanvas(x2), yToCanvas(0), 4, 0, 2 * Math.PI);
                ctx.fill();
            }
        }
    });
}

// Auto-render graphs when DOM is loaded
document.addEventListener('DOMContentLoaded', renderQuadraticGraphs);

// Re-render graphs when window is resized
window.addEventListener('resize', function() {
    setTimeout(renderQuadraticGraphs, 100);
});

// Make function globally available
window.renderQuadraticGraphs = renderQuadraticGraphs;