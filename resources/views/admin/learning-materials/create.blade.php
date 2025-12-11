@extends('layouts.dashboard')

@section('title', 'Create Learning Material')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="d-flex justify-content-between align-items-center py-3 mb-4">
        <div>
            <h4 class="fw-bold mb-0">
                <span class="text-muted fw-light">Admin / Learning Materials /</span> Create
            </h4>
            <p class="text-muted">Add new quadratic function learning material</p>
        </div>
        <a href="{{ route('admin.learning-materials.index') }}" class="btn btn-outline-secondary">
            <i class="bx bx-arrow-back me-1"></i>
            Back to List
        </a>
    </div>

    <form action="{{ route('admin.learning-materials.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-lg-8 mb-4">
                <!-- Basic Information -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Basic Information</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-8 mb-3">
                                <label for="title" class="form-label">Title <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror"
                                       id="title" name="title" value="{{ old('title') }}" required>
                                @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="order" class="form-label">Order <span class="text-danger">*</span></label>
                                <input type="number" class="form-control @error('order') is-invalid @enderror"
                                       id="order" name="order" value="{{ old('order', 1) }}" required min="1">
                                @error('order')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="type" class="form-label">Type <span class="text-danger">*</span></label>
                                <select class="form-select @error('type') is-invalid @enderror" id="type" name="type" required>
                                    <option value="">Select Type</option>
                                    <option value="pendahuluan" {{ old('type') === 'pendahuluan' ? 'selected' : '' }}>
                                        Pendahuluan
                                    </option>
                                    <option value="materi" {{ old('type') === 'materi' ? 'selected' : '' }}>
                                        Materi
                                    </option>
                                    <option value="latihan" {{ old('type') === 'latihan' ? 'selected' : '' }}>
                                        Latihan
                                    </option>
                                    <option value="evaluasi" {{ old('type') === 'evaluasi' ? 'selected' : '' }}>
                                        Evaluasi
                                    </option>
                                </select>
                                @error('type')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="min_score" class="form-label">Minimum Score (%) <span class="text-danger">*</span></label>
                                <input type="number" class="form-control @error('min_score') is-invalid @enderror"
                                       id="min_score" name="min_score" value="{{ old('min_score', 75) }}"
                                       required min="0" max="100">
                                @error('min_score')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control @error('description') is-invalid @enderror"
                                      id="description" name="description" rows="3">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Content -->
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="card-title mb-0">Content <span class="text-danger">*</span></h5>
                            <small class="text-muted">Use MathJax syntax for mathematical equations (e.g., $$x^2 + bx + c = 0$$)</small>
                        </div>
                        <button type="button" class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#graphModal">
                            <i class="bx bx-line-chart me-1"></i>Insert Graph
                        </button>
                    </div>
                    <div class="card-body">
                        <textarea class="form-control @error('content') is-invalid @enderror"
                                  id="content" name="content" rows="15" required>{{ old('content') }}</textarea>
                        @error('content')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                        <!-- Graph Preview Area -->
                        <div class="mt-3 d-none" id="graphPreviewArea">
                            <h6>Graph Preview:</h6>
                            <div class="border p-3 bg-light rounded">
                                <canvas id="graphPreview" width="500" height="300"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Math Symbols & References -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Math Symbols & References</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label">Math Symbols (JSON format)</label>
                            <textarea class="form-control @error('math_symbols') is-invalid @enderror"
                                      name="math_symbols" rows="3"
                                      placeholder='{"sqrt": "√", "alpha": "α", "beta": "β", "gamma": "γ"}'>{{ old('math_symbols') }}</textarea>
                            @error('math_symbols')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">Enter common math symbols as JSON for quick insertion</small>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">References (JSON format)</label>
                            <textarea class="form-control @error('references') is-invalid @enderror"
                                      name="references" rows="3"
                                      placeholder='["Reference 1", "Reference 2", "Reference 3"]'>{{ old('references') }}</textarea>
                            @error('references')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">List of references for this material</small>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <!-- Publish Settings -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Publish Settings</h5>
                    </div>
                    <div class="card-body">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="is_published"
                                   name="is_published" value="1" {{ old('is_published') ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_published">
                                Publish immediately
                            </label>
                        </div>
                        <small class="form-text text-muted">
                            Published materials will be visible to students
                        </small>
                    </div>
                </div>

                <!-- File Attachments -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Attachments</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="attachments" class="form-label">Upload Files</label>
                            <input type="file" class="form-control @error('attachments.*') is-invalid @enderror"
                                   id="attachments" name="attachments[]" multiple
                                   accept=".jpg,.jpeg,.png,.pdf,.doc,.docx">
                            @error('attachments.*')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">
                                Supported formats: JPG, PNG, PDF, DOC, DOCX (Max: 2MB each)
                            </small>
                        </div>
                    </div>
                </div>

                <!-- Actions -->
                <div class="card">
                    <div class="card-body">
                        <button type="submit" class="btn btn-primary w-100 mb-2">
                            <i class="bx bx-save me-1"></i>
                            Create Material
                        </button>
                        <a href="{{ route('admin.learning-materials.index') }}" class="btn btn-outline-secondary w-100">
                            Cancel
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <!-- Graph Modal -->
    <div class="modal fade" id="graphModal" tabindex="-1" aria-labelledby="graphModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="graphModalLabel">
                        <i class="bx bx-line-chart me-2"></i>Insert Quadratic Function Graph
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h6 class="mb-3">Function Parameters</h6>

                            <div class="mb-3">
                                <label for="coefficientA" class="form-label">Coefficient a</label>
                                <input type="number" class="form-control" id="coefficientA" value="1" step="0.1">
                                <small class="text-muted">Controls the opening width and direction</small>
                            </div>

                            <div class="mb-3">
                                <label for="coefficientB" class="form-label">Coefficient b</label>
                                <input type="number" class="form-control" id="coefficientB" value="0" step="0.1">
                                <small class="text-muted">Controls the horizontal position</small>
                            </div>

                            <div class="mb-3">
                                <label for="coefficientC" class="form-label">Coefficient c</label>
                                <input type="number" class="form-control" id="coefficientC" value="0" step="0.1">
                                <small class="text-muted">Controls the vertical position (y-intercept)</small>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Function: </label>
                                <div class="bg-light p-2 rounded">
                                    <strong id="functionDisplay">f(x) = x²</strong>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="graphTitle" class="form-label">Graph Title (Optional)</label>
                                <input type="text" class="form-control" id="graphTitle" placeholder="Graph of f(x) = x²">
                            </div>

                            <div class="mb-3">
                                <h6>Graph Settings</h6>
                                <div class="row">
                                    <div class="col-6">
                                        <label for="xMin" class="form-label">X Min</label>
                                        <input type="number" class="form-control" id="xMin" value="-5" step="1">
                                    </div>
                                    <div class="col-6">
                                        <label for="xMax" class="form-label">X Max</label>
                                        <input type="number" class="form-control" id="xMax" value="5" step="1">
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <div class="row">
                                    <div class="col-6">
                                        <label for="yMin" class="form-label">Y Min</label>
                                        <input type="number" class="form-control" id="yMin" value="-5" step="1">
                                    </div>
                                    <div class="col-6">
                                        <label for="yMax" class="form-label">Y Max</label>
                                        <input type="number" class="form-control" id="yMax" value="5" step="1">
                                    </div>
                                </div>
                            </div>

                            <button type="button" class="btn btn-success w-100" id="updateGraphBtn">
                                <i class="bx bx-refresh me-1"></i>Update Graph
                            </button>
                        </div>

                        <div class="col-md-6">
                            <h6 class="mb-3">Graph Preview</h6>
                            <div class="border rounded p-3 bg-light">
                                <canvas id="modalGraphCanvas" width="400" height="300"></canvas>
                            </div>

                            <div class="mt-3">
                                <h6>Key Points</h6>
                                <div id="keyPoints" class="small">
                                    <div>Vertex: <span id="vertexPoint">(0, 0)</span></div>
                                    <div>Y-intercept: <span id="yInterceptPoint">(0, 0)</span></div>
                                    <div>Discriminant: <span id="discriminant">0</span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="insertGraphBtn">
                        <i class="bx bx-plus me-1"></i>Insert Graph
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

@push('script')
<script>
// Define all functions first to avoid reference errors
function updateFunctionDisplay() {
    const a = parseFloat(document.getElementById('coefficientA').value) || 1;
    const b = parseFloat(document.getElementById('coefficientB').value) || 0;
    const c = parseFloat(document.getElementById('coefficientC').value) || 0;

    let functionStr = 'f(x) = ';

    // a coefficient
    if (a === 1) {
        functionStr += 'x²';
    } else if (a === -1) {
        functionStr += '-x²';
    } else {
        functionStr += a + 'x²';
    }

    // b coefficient
    if (b > 0) {
        functionStr += ' + ' + (b === 1 ? '' : b) + 'x';
    } else if (b < 0) {
        functionStr += ' - ' + (b === -1 ? '' : Math.abs(b)) + 'x';
    }

    // c coefficient
    if (c > 0) {
        functionStr += ' + ' + c;
    } else if (c < 0) {
        functionStr += ' - ' + Math.abs(c);
    }

    document.getElementById('functionDisplay').textContent = functionStr;
}

function updateGraph() {
    console.log("APA KAU FANTEK")

    const canvas = document.getElementById('modalGraphCanvas');
    const ctx = canvas.getContext('2d');

    // Clear canvas
    ctx.clearRect(0, 0, canvas.width, canvas.height);

    // Get parameters
    const a = parseFloat(document.getElementById('coefficientA').value) || 1;
    const b = parseFloat(document.getElementById('coefficientB').value) || 0;
    const c = parseFloat(document.getElementById('coefficientC').value) || 0;
    const xMin = parseFloat(document.getElementById('xMin').value) || -5;
    const xMax = parseFloat(document.getElementById('xMax').value) || 5;
    const yMin = parseFloat(document.getElementById('yMin').value) || -5;
    const yMax = parseFloat(document.getElementById('yMax').value) || 5;

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
    for (let x = xMin; x <= xMax; x += 0.1) {
        const y = quadratic(x);
        if (y >= yMin && y <= yMax) {
            const canvasX = xToCanvas(x);
            const canvasY = yToCanvas(y);

            if (firstPoint) {
                ctx.moveTo(canvasX, canvasY);
                firstPoint = false;
            } else {
                ctx.lineTo(canvasX, canvasY);
            }
        }
    }
    ctx.stroke();

    // Calculate and display key points
    const vertex_x = -b / (2 * a);
    const vertex_y = quadratic(vertex_x);
    const discriminant = b * b - 4 * a * c;

    // Draw vertex
    if (vertex_x >= xMin && vertex_x <= xMax && vertex_y >= yMin && vertex_y <= yMax) {
        ctx.fillStyle = '#dc3545';
        ctx.beginPath();
        ctx.arc(xToCanvas(vertex_x), yToCanvas(vertex_y), 5, 0, 2 * Math.PI);
        ctx.fill();
    }

    // Draw y-intercept
    if (c >= yMin && c <= yMax && 0 >= xMin && 0 <= xMax) {
        ctx.fillStyle = '#28a745';
        ctx.beginPath();
        ctx.arc(xToCanvas(0), yToCanvas(c), 4, 0, 2 * Math.PI);
        ctx.fill();
    }

    // Update key points display
    document.getElementById('vertexPoint').textContent = `(${vertex_x.toFixed(2)}, ${vertex_y.toFixed(2)})`;
    document.getElementById('yInterceptPoint').textContent = `(0, ${c})`;
    document.getElementById('discriminant').textContent = discriminant.toFixed(2) + (discriminant > 0 ? ' (2 real roots)' : discriminant === 0 ? ' (1 real root)' : ' (no real roots)');
}

function insertGraph() {
    const a = parseFloat(document.getElementById('coefficientA').value) || 1;
    const b = parseFloat(document.getElementById('coefficientB').value) || 0;
    const c = parseFloat(document.getElementById('coefficientC').value) || 0;
    const title = document.getElementById('graphTitle').value;
    const xMin = parseFloat(document.getElementById('xMin').value) || -5;
    const xMax = parseFloat(document.getElementById('xMax').value) || 5;
    const yMin = parseFloat(document.getElementById('yMin').value) || -5;
    const yMax = parseFloat(document.getElementById('yMax').value) || 5;

    // Generate graph code to insert into content
    let graphHtml = '\n\n<div class="quadratic-graph" data-a="' + a + '" data-b="' + b + '" data-c="' + c + '"';
    graphHtml += ' data-x-min="' + xMin + '" data-x-max="' + xMax + '"';
    graphHtml += ' data-y-min="' + yMin + '" data-y-max="' + yMax + '">';

    if (title) {
        graphHtml += '\n  <h6 class="text-center">' + title + '</h6>';
    }

    graphHtml += '\n  <div class="text-center bg-light p-3 rounded border">';
    graphHtml += '\n    <canvas class="quadratic-canvas" width="500" height="300"></canvas>';
    graphHtml += '\n    <div class="mt-2">';

    // Function display
    let functionStr = 'f(x) = ';
    if (a === 1) {
        functionStr += 'x²';
    } else if (a === -1) {
        functionStr += '-x²';
    } else {
        functionStr += a + 'x²';
    }

    if (b > 0) {
        functionStr += ' + ' + (b === 1 ? '' : b) + 'x';
    } else if (b < 0) {
        functionStr += ' - ' + (b === -1 ? '' : Math.abs(b)) + 'x';
    }

    if (c > 0) {
        functionStr += ' + ' + c;
    } else if (c < 0) {
        functionStr += ' - ' + Math.abs(c);
    }

    graphHtml += '\n      <strong>' + functionStr + '</strong>';

    const vertex_x = -b / (2 * a);
    const vertex_y = a * vertex_x * vertex_x + b * vertex_x + c;

    graphHtml += '\n      <br><small class="text-muted">Vertex: (' + vertex_x.toFixed(2) + ', ' + vertex_y.toFixed(2) + ')</small>';
    graphHtml += '\n    </div>';
    graphHtml += '\n  </div>';
    graphHtml += '\n</div>\n\n';

    // Insert into content textarea
    const contentTextarea = document.getElementById('content');
    const cursorPos = contentTextarea.selectionStart;
    const textBefore = contentTextarea.value.substring(0, cursorPos);
    const textAfter = contentTextarea.value.substring(contentTextarea.selectionEnd);

    contentTextarea.value = textBefore + graphHtml + textAfter;
    contentTextarea.selectionStart = contentTextarea.selectionEnd = cursorPos + graphHtml.length;
    contentTextarea.focus();

    // Close modal
    const modal = bootstrap.Modal.getInstance(document.getElementById('graphModal'));
    modal.hide();

    // Show preview
    showGraphPreview();
}

function showGraphPreview() {
    const content = document.getElementById('content').value;
    const previewArea = document.getElementById('graphPreviewArea');

    if (content.includes('quadratic-graph')) {
        previewArea.classList.remove('d-none');
        // Here you could render a preview of the graphs in the content
    } else {
        previewArea.classList.add('d-none');
    }
}

console.log('AKU RINDU PADA DIRIMU')
// Initialize everything when DOM is loaded
document.addEventListener('DOMContentLoaded', function() {
    console.log('AKU RINDU PADA DIRIMU')
    // Auto-generate slug from title
    const titleInput = document.getElementById('title');

    titleInput.addEventListener('input', function() {
        // You can add slug preview functionality here if needed
    });

    // Initialize graph when modal opens
    document.getElementById('graphModal').addEventListener('shown.bs.modal', function() {
        updateGraph();
    });

    // Update function display when coefficients change
    ['coefficientA', 'coefficientB', 'coefficientC'].forEach(id => {
        document.getElementById(id).addEventListener('input', updateFunctionDisplay);
    });

    // Add event listeners for buttons
    console.log(document.getElementById('updateGraphBtn'))
    document.getElementById('updateGraphBtn').addEventListener('click', updateGraph);
    document.getElementById('insertGraphBtn').addEventListener('click', insertGraph);

    // Show preview when content changes
    document.getElementById('content').addEventListener('input', showGraphPreview);

    updateFunctionDisplay();
});
</script>
@endpush
@endsection
