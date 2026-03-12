"use client";

import { useEffect, useState } from "react";
import { useRouter } from "next/navigation";

type User = {
  id: number;
  name?: string;
  email: string;
};

export default function DashboardPage() {
  const router = useRouter();
  const [user, setUser] = useState<User | null>(null);

  useEffect(() => {
    async function fetchUser() {
      try {
        const res = await fetch("http://localhost:8000/api/user", {
          credentials: "include",
        });

        if (!res.ok) {
          router.push("/auth"); // redirect if not logged in
          return;
        }

        const data: User = await res.json();
        setUser(data);
      } catch {
        router.push("/auth");
      }
    }

    fetchUser();
  }, [router]);

  const handleLogout = async () => {
    await fetch("http://localhost:8000/api/logout", {
      method: "POST",
      credentials: "include",
    });
    router.push("/auth");
  };

  if (!user) return <p>Loading...</p>;

  return (
    <div className="p-6">
      <h1 className="text-3xl mb-4">Welcome, {user.name || user.email}</h1>
      <button
        onClick={handleLogout}
        className="bg-red-500 text-white p-2 rounded"
      >
        Logout
      </button>
    </div>
  );
}