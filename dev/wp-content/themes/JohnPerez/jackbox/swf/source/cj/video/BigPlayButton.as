package cj.video  {
	
	import flash.display.Sprite;
	import flash.events.Event;
	import flash.events.MouseEvent;
	
	import com.greensock.TweenNano;
	import com.greensock.easing.Quint;
	
	import cj.video.events.VideosEvent;
	
	public final class BigPlayButton extends Sprite {
		
		private var isPlaying:Boolean;
		
		public function BigPlayButton(auto:Boolean) {
			
			isPlaying = auto;
			
			if(isPlaying) {
				
				this.alpha = 0;
				this.mouseEnabled = false;
				
			}
			else {
				
				this.buttonMode = true;
				
			}
			
			addEventListener(Event.ADDED_TO_STAGE, added);
			
		}
		
		private function added(event:Event):void {
			
			removeEventListener(Event.ADDED_TO_STAGE, added);
			
			sizer();
			stage.addEventListener(Event.RESIZE, sizer, false, 0, true);
			
			addEventListener(MouseEvent.CLICK, clicked);
			addEventListener(Event.REMOVED_FROM_STAGE, removed);
			
		}
		
		private function sizer(event:Event = null):void {
			
			this.x = stage.stageWidth >> 1;
			this.y = stage.stageHeight >> 1;
			
		}
		
		private function clicked(event:MouseEvent):void {
			
			event.stopPropagation();
			
			if(!isPlaying) dispatchEvent(new VideosEvent(VideosEvent.CLICKED, "playBtn", 0));
			
		}
		
		internal function playIt():void {
			
			this.buttonMode = this.mouseEnabled = false;
			
			isPlaying = true;
			
			TweenNano.to(this, 0.75, {alpha: 0, ease: Quint.easeOut});
			
		}
		
		internal function pauseIt(event:MouseEvent = null):void {
			
			this.buttonMode = this.mouseEnabled = true;
			
			isPlaying = false;
			
			TweenNano.to(this, 0.75, {alpha: 1, ease: Quint.easeOut});
			
		}
		
		private function removed(event:MouseEvent):void {
			
			removeEventListener(Event.REMOVED_FROM_STAGE, removed);
			removeEventListener(MouseEvent.CLICK, clicked);
			removeEventListener(Event.ADDED_TO_STAGE, added);
			
			TweenNano.killTweensOf(this);
			
			if(stage != null) stage.removeEventListener(Event.RESIZE, sizer);
			
		}

	}
	
}










