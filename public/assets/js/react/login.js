function CardHeader(props) {
  return (
    <div className="card-header text-center">
      <img
        src="<?= base_url('filemanager/logo.png'); ?>"
        alt="RDMP JO"
        className="img-responsive my-3"
        style={{ maxWidth: "300px" }}
      />
      <p>{props.auth}</p>
    </div>
  );
}
