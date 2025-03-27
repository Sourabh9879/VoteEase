@extends('layouts.app')

@section('title', 'Results')

@section('styles')
<style>
    .progress {
        height: 25px;
        border-radius: 15px;
    }
    .total-votes {
        font-weight: bold;
        color: #3490dc;
    }
</style>
@endsection

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <h2 class="mb-3"><i class="fas fa-chart-bar me-2"></i>Election Results</h2>
                    <p class="text-muted">
                        View the current standings in the election. Results are updated in real-time.
                    </p>
                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <span id="last-updated">Last updated: Just now</span>
                        <button id="refresh-btn" class="btn btn-sm btn-outline-primary">
                            <i class="fas fa-sync-alt me-1"></i> Refresh Results
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="loading-indicator" class="text-center py-5">
        <div class="spinner-border text-primary" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
        <p class="mt-2">Loading results...</p>
    </div>

    <div id="results-container" style="display: none;">
        <div class="row mb-4">
            <div class="col-md-12">
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4">
                        <h4 class="mb-3">Current Standing</h4>
                        <div id="total-votes-info" class="mb-4">
                            <span class="total-votes" id="total-votes">0</span> total votes cast
                        </div>
                        <div id="results-list">
                            <!-- Results will be loaded here -->
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4">
                        <h4 class="mb-4">Results Chart</h4>
                        <div class="chart-container" style="position: relative; height:300px;">
                            <canvas id="resultsChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div id="error-container" class="alert alert-danger mt-4" style="display: none;"></div>
</div>
@endsection

@section('scripts')
<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    $(document).ready(function() {
        let resultsChart = null;
        let lastLoadTime = new Date();
        
        // Function to format time
        function formatTime(date) {
            const hours = date.getHours().toString().padStart(2, '0');
            const minutes = date.getMinutes().toString().padStart(2, '0');
            const seconds = date.getSeconds().toString().padStart(2, '0');
            return `${hours}:${minutes}:${seconds}`;
        }
        
        // Function to generate random colors
        function getRandomColor() {
            const letters = '0123456789ABCDEF';
            let color = '#';
            for (let i = 0; i < 6; i++) {
                color += letters[Math.floor(Math.random() * 16)];
            }
            return color;
        }
        
        // Function to load results
        function loadResults() {
            $('#loading-indicator').show();
            $('#results-container').hide();
            $('#error-container').hide();
            
            $.ajax({
                url: '/api/getvotes',
                type: 'GET',
                success: function(candidates) {
                    $('#loading-indicator').hide();
                    
                    if (candidates.length === 0) {
                        $('#error-container').text('No election results are available at this time.').show();
                        return;
                    }
                    
                    // Sort candidates by vote count (descending)
                    candidates.sort((a, b) => b.vote_count - a.vote_count);
                    
                    // Calculate total votes
                    const totalVotes = candidates.reduce((sum, candidate) => sum + candidate.vote_count, 0);
                    $('#total-votes').text(totalVotes);
                    
                    // Generate results list
                    const resultsList = $('#results-list');
                    resultsList.empty();
                    
                    // Prepare chart data
                    const labels = [];
                    const data = [];
                    const backgroundColors = [];
                    
                    candidates.forEach(function(candidate, index) {
                        const percentage = totalVotes > 0 ? (candidate.vote_count / totalVotes * 100).toFixed(1) : '0.0';
                        
                        const resultItem = `
                            <div class="candidate-result mb-4">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <div>
                                        <h5 class="mb-0">${candidate.name}</h5>
                                        <small class="text-muted">${candidate.party}</small>
                                    </div>
                                    <div class="vote-count">
                                        ${candidate.vote_count} votes (${percentage}%)
                                    </div>
                                </div>
                                <div class="progress">
                                    <div class="progress-bar ${index === 0 ? 'bg-success' : 'bg-primary'}" 
                                         role="progressbar" 
                                         style="width: ${percentage}%" 
                                         aria-valuenow="${percentage}" 
                                         aria-valuemin="0" 
                                         aria-valuemax="100">
                                        ${percentage}%
                                    </div>
                                </div>
                            </div>
                        `;
                        
                        resultsList.append(resultItem);
                        
                        // Add to chart data
                        labels.push(candidate.name);
                        data.push(candidate.vote_count);
                        backgroundColors.push(getRandomColor());
                    });
                    
                    // Create or update chart
                    if (resultsChart) {
                        resultsChart.data.labels = labels;
                        resultsChart.data.datasets[0].data = data;
                        resultsChart.data.datasets[0].backgroundColor = backgroundColors;
                        resultsChart.update();
                    } else {
                        const ctx = document.getElementById('resultsChart').getContext('2d');
                        resultsChart = new Chart(ctx, {
                            type: 'bar',
                            data: {
                                labels: labels,
                                datasets: [{
                                    label: 'Number of Votes',
                                    data: data,
                                    backgroundColor: backgroundColors,
                                    borderWidth: 1
                                }]
                            },
                            options: {
                                responsive: true,
                                maintainAspectRatio: false,
                                scales: {
                                    y: {
                                        beginAtZero: true,
                                        ticks: {
                                            precision: 0
                                        }
                                    }
                                }
                            }
                        });
                    }
                    
                    $('#results-container').show();
                    
                    // Update last loaded time
                    lastLoadTime = new Date();
                    $('#last-updated').text(`Last updated: ${formatTime(lastLoadTime)}`);
                },
                error: function(xhr) {
                    $('#loading-indicator').hide();
                    $('#error-container').text('Failed to load results. Please try again later.').show();
                }
            });
        }
        
        // Initial load
        loadResults();
        
        // Refresh button handler
        $('#refresh-btn').click(function() {
            loadResults();
        });
        
        // Auto refresh every 30 seconds
        setInterval(loadResults, 30000);
    });
</script>
@endsection 