 <!-- The Modal -->
<div class="modal fade" id="printRangeInfo">
  <div class="modal-dialog">
    <div class="modal-content rounded-0">

      <!-- Modal Header -->
      <div class="modal-header">
        <h3 class="modal-title">(Message Here)</h3>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
          <form method="POST">
        <div class="row">
            @csrf
            <div class="col-md-6">
            <select class="form-control" name="from_year" id="fromYear">
              <option selected disabled>From Year : </option>
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
              <option value="4">5</option>
            </select>
          </div>
          <div class="col-md-6">
            <select class="form-control" name="to_year" id="toYear">
              <option selected disabled>To Year : </option>
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
              <option value="4">5</option>
            </select>
          </div>
        </div>
      </div>

      <input type="hidden" id="studentGrades" name="student_grades">
      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="submit" id="printWithRange" class="btn btn-primary">Submit</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
          </form>
      </div>

