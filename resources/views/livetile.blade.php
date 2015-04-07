<tile>
   <visual lang="en-US" version="2">
      <binding template="TileSquare310x310ImageAndTextOverlay02" branding="name">
         <image id="1" src="/images/{{ $product->images[0]->id }}" />
         <text id="1">{{ $product->name }} </text>
         <text id="2">{{ $product->finalPrice .' '. config('app.checkout_currency') }}</text>
      </binding>
      <binding template="TileWide310x150ImageAndText01" branding="logo">
         <image id="1" src="/images/{{ $product->images[0]->id }}" />
         <text id="1">{{ $product->name }} </text>
      </binding>
      <binding template="TileSquare150x150Image" branding="name">
         <image id="1" src="/images/{{ $product->images[0]->id }}" />
      </binding>
   </visual>
</tile>