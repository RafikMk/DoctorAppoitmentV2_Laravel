@if (count($bookings) > 0)
<div class="modal fade" id="prescriptionModal{{ $booking->user_id }}" tabindex="-1" aria-labelledby="prescriptionModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="prescriptionModalLabel">Create Prescription</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{ route('store.prescription') }}" method="POST">@csrf
            <div class="modal-body" id="app">
                <input type="hidden" name="user_id" value="{{ $booking->user_id }}">
                <input type="hidden" name="doctor_id" value="{{ $booking->doctor_id }}">
                <input type="hidden" name="date" value="{{ $booking->date }}">

                <div class="form-group">
                    <label>Ailment</label>
                    <input type="text" name="ailment" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Symptoms</label>
                    <textarea name="symptoms" class="form-control" placeholder="Symptoms" required></textarea>
                </div>
                <div class="form-group">
                    <label>Medicine</label>
                    <input-field />
                </div>
                <div class="form-group">
                    <label>Procedure</label>
                    <textarea name="procedure" class="form-control" placeholder="Procedure to use medicine" required></textarea>
                </div>
                <div class="form-group">
                    <label>Feedback</label>
                    <textarea name="feedback" class="form-control" placeholder="Feedback" required></textarea>
                </div>
                <div class="form-group">
                    <label>Signature</label>
                    <input type="text" name="signature" class="form-control" required>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
        </form>
      </div>
    </div>
  </div>
@endif