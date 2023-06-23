<div class="row">
    <div class="col-lg-12">
        <label for="question">Question</label>
        <textarea name="question" id="texteditor" class="texteditor">
            @isset($faq->question)
{!! $faq->question !!}
@endisset
        </textarea>
    </div>
</div>
<br>
<div class="row">
    <div class="col-lg-12">
        <label for="answer">Answer</label>
        <textarea name="answer" id="heavytexteditor" class="answer">
                    @isset($faq->answer)
{!! $faq->answer !!}
@endisset
                </textarea>
    </div>
</div>
<br>
<x-adminetic-edit-add-button :model="$faq ?? null" name="FAQ" />
