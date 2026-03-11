// src/app/page.tsx
async function getData() {
  const res = await fetch(`${process.env.NEXT_PUBLIC_API_URL}/test`);
  return res.json();
}

export default async function Page() {
  const data = await getData();

  return (
    <div>
      <h1>{data.message}</h1>
    </div>
  );
}