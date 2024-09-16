<!-- Modal -->
<div class="modal fade" id="modalUpdate" tabindex="-1" role="dialog" aria-labelledby="modalUpdateLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h6 class="modal-title" id="modalUpdateLabel"><i class="la la-info-circle"></i> Welcome to ZW Internet in a Box</h6>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <p>This is an administrator dashboard.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Scripts -->
<script>
    // jQuery UI slider initialization
    $(document).ready(function() {
        $("#slider").slider({
            range: "min",
            max: 100,
            value: 40,
        });
        
        $("#slider-range").slider({
            range: true,
            min: 0,
            max: 500,
            values: [75, 300],
        });
    });
</script>
