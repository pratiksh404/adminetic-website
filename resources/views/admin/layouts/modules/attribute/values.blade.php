 @isset($attribute->values)
     @foreach ($attribute->values as $value)
         <span class="badge badge-primary">{{ $value }}</span>
     @endforeach
 @endisset
