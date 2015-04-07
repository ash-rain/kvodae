@if($notifications > 0)
<badge version="1" value="{{ $notifications }}" />
@endif
<tile>
  <visual>
    <binding template="TileSquarePeekImageAndText01">
      <image id="1" src="{{ url('images/' . $product->images[0]->id) }}" />
      <text id="1">{{ $product->name }}</text>
      <text id="2">{{ $product->finalPrice .' '. config('app.checkout_currency') }}</text>
      <text id="3">{{ $product->template->name }}</text>
    </binding>  
  </visual>
</tile>

<tile>
  <visual version="2">
    <binding template="TileSquare150x150PeekImageAndText01" fallback="TileSquarePeekImageAndText01">
      <image id="1" src="{{ url('images/' . $product->images[0]->id) }}" />
      <text id="1">{{ $product->name }}</text>
      <text id="2">{{ $product->finalPrice .' '. config('app.checkout_currency') }}</text>
      <text id="3">{{ $product->template->name }}</text>
   </binding>  
  </visual>
</tile>