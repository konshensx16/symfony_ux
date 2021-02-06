import { Controller } from 'stimulus';

export default class extends Controller {
  connect() {
    this.element.addEventListener('cropperjs:connect', this._onConnect);
  }

  disconnect() {
    // You should always remove listeners when the controller is disconnected to avoid side effects
    this.element.removeEventListener('cropperjs:connect', this._onConnect);
  }

  _onConnect(event) {
    console.log(event.detail.cropper);
    console.log(event.detail.options);
    console.log(event.detail.img);

    event.detail.img.addEventListener('cropend', function () {
      console.log("ended crojopamndkjwnbd")
    });
  }
}