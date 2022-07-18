<div class="float-right">
    <form method="POST" name="rating" id="rating">
        @csrf
        <input type="hidden" name="user_id" value="{{ auth()->id() }}">
        <input type="hidden" name="ticket_id" value="{{ $ticket->id }}">
        <h5>OverAll Satisfaction</h5>
        <div class="rate">
            <input {{ !empty($ratings->rating) && $ratings->rating == 5 ? 'checked' : '' }} type="radio"
                class="rating" id="star5" name="rate" value="5" />
            <label for="star5" class="fa fa-star">5 stars</label>
            <input {{ !empty($ratings->rating) && $ratings->rating == 4 ? 'checked' : '' }} type="radio"
                class="rating" id="star4" name="rate" value="4" />
            <label for="star4" class="fa fa-star">4 stars</label>
            <input {{ !empty($ratings->rating) && $ratings->rating == 3 ? 'checked' : '' }} type="radio"
                class="rating" id="star3" name="rate" value="3" />
            <label for="star3" class="fa fa-star">3 stars</label>
            <input type="radio" class="rating" id="star2" name="rate" value="2" />
            <label for="star2" class="fa fa-star">2 stars</label>
            <input {{ !empty($ratings->rating) && $ratings->rating == 1 ? 'checked' : '' }} type="radio"
                class="rating" id="star1" name="rate" value="1" />
            <label for="star1" class="fa fa-star">1 star</label>
        </div>
    </form>
</div>
